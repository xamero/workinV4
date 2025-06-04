<?php

namespace App\Livewire\Applicant\Jobs\Application;

use Carbon\Carbon;
use App\Models\Vacancy;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use App\Models\JobApplication;
use Livewire\Attributes\Locked;
use App\Models\ApplicantProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use App\Notifications\Applicant\Job\Application\ApplicationToEmployerNotification;
use App\Notifications\Applicant\Job\Application\ApplicationToApplicantNotification;


class Apply extends Component
{
    public $letter, $letters;

    #[Locked]
    public $activeVacancy, $isApplicationExists;
    public $vacancyId;


    protected $rules = [
        'letter' => 'required|string',
    ];

    protected $messages = [

    ];

    protected $validationAttributes = [
        'letter' => 'cover letter'
    ];

    public function  mount($id)
    {
        $this->vacancyId = $id;
    }

    public function apply(){
        $this->dispatch('show-tinyMce' );
    }

    #[On('saveApplication')]
    public function saveApplication($letter){

        try {
            $profile = ApplicantProfile::where('user_id', Auth::user()->id)->first();

            if($profile){
                $this->letter = $letter;

                $letter = $this->validate();

                $accessCode = Str::random(32);
                $appliedAt = Carbon::now();
                $profile->application()->syncWithoutDetaching([$this->activeVacancy->id => ['applied_at'=>$appliedAt, 'cover_letter'=>$this->letter, 'access_code'=>$accessCode]]);
                $this->dispatch('show-tinyMce' );

                Auth::user()->notify(new ApplicationToApplicantNotification($profile->firstname, $this->activeVacancy->company->name, $this->activeVacancy->title));
                $this->activeVacancy->company->notify(new ApplicationToEmployerNotification($profile->firstname, $this->activeVacancy->company->name, $this->activeVacancy->title));

                $companyId = $this->activeVacancy->company->id;
//                $employer = User::whereHas('employer_profile', function($query) use($companyId) {
//                    $query->where('company_id', $companyId);
//                })->get();
//                dd($employer);
                session()->flash('success', 'Your application has been submitted.');

            }else{
                session()->flash('error', 'application.');
            }

        } catch (QueryException $e) {
            session()->flash('error', 'Ooops, something unexpected happened. Please try again later.');
        }
    }

    public function render()
    {
        $this->activeVacancy = Vacancy::findOrFail($this->vacancyId);

        $this->isApplicationExists = Vacancy::where('id', $this->activeVacancy->id)->whereHas('applicantProfile', function($query){
            $query->where('applicant_profile_vacancy.applicant_profile_id', Auth::user()->applicant_profile->id);
        })->with('applicantProfile')->first();


        return view('livewire.applicant.jobs.application.apply');
    }
}
