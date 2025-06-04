<?php

namespace App\Livewire\Employer\Applicants;

use App\Livewire\Employer\Vacancy\Applicant;
use App\Mail\ResponseToApplicant;
use App\Models\ApplicantProfile;
use App\Models\JobApplication;
use App\Models\Vacancy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Locked;
use Livewire\Component;

class Profile extends Component
{

    #[Locked]
    public $vacancy_id, $vacancy, $company, $user;

    public $applicant, $applicant_id, $subject, $emailto, $replyto, $inviDetails, $application, $action;

//    public function showProfile($applicant)
//    {
//       $this->applicant = ApplicantProfile::where('id', '=', $applicant)
//       ->with('application')
//       ->first();
//        $this->subject = $this->company->name . ': Invitation for Interview';
//        $this->emailto = $this->applicant->user->email;
//        $this->replyto = Auth::user()->email;
//        $this->dispatch('show-tinyMce');
//
//    }


    public function sendEmail()
    {
        try {
            $this->application->status = $this->action;
            $this->application->save;
            Mail::to($this->emailto)
                ->cc($this->replyto)
                ->send(new ResponseToApplicant($this->inviDetails, $this->company, $this->replyto, $this->subject));
            Session::flash("success", "Your email was sent successfully");
        } catch (\Exception $exception) {
            Session::flash("error", "Ooops, we've met an error while trying to send your email. Please try again later.");
        }
    }

    public function mount()
    {
        $this->user = Auth::user();
        $user_company_id = $this->user->employer_profile->company_id;


        $this->vacancy = Vacancy::where('id', '=', $this->vacancy_id)
            ->where('company_id', $user_company_id)
            ->withTrashed()
            ->first();


        $this->company = $this->vacancy->company;

        $this->applicant = ApplicantProfile::where('id', '=', $this->applicant_id)
            ->first();

        $this->application = JobApplication::where('vacancy_id', $this->vacancy_id)
            ->where('applicant_profile_id', $this->applicant_id)
            ->whereHas('vacancy', function ($query) use ($user_company_id) {
                $query->where('company_id', $user_company_id)->withTrashed();
            })
            ->orderBy('created_at', 'desc')
            ->first();

//        dd($this->application);

        $this->emailto = $this->applicant->user->email;
        $this->replyto = Auth::user()->email;
        $this->action = 1;

        $this->dispatch('show-tinyMce');
    }

    public function reject()
    {
        $this->subject = 'Application update for ' . $this->vacancy->title . ' position';
        $this->action = 2;
        //set invite template
        $this->inviDetails =
            "<p>Dear " . $this->applicant->firstname . ",</p>" .
            "<br>" .
            "<p>Thank you for your interest in the " . $this->vacancy->title .
            " position at " . $this->company->name . " and for taking the time to submit your application. </p>" .
            "<br>" .
            "<p>After careful consideration, we regret to inform you that we have decided to pursue other candidates whose skills and experiences more closely match our requirements at this time.</p>" .
            "<br>" .
            "<p> We will keep your application on file for future opportunities that may be a better fit for your qualifications. " .
            "Thank you again for your interest in " . $this->company->name . ", and we wish you the best of luck in your job search. </p>" .
            "<br>" .
            "<p> Best regards, </p>" .
            "<br>" .
            "<p>" . $this->user->name . "</p>" .
            "<p> .[Your Title] </p>" .
            "<p>" . $this->company->name . "</p>";

        $this->dispatch('show-tinyMce');
    }


    public function invite()
    {

        $this->subject = 'Interview invitation for ' . $this->vacancy->title . ' position';
        $this->action = 1;
        //set invite template
        $this->inviDetails =
            "<p>Dear " . $this->applicant->firstname . ",</p>" .
            "<br>" .
            "<p>Thank you for your application for the " . $this->vacancy->title .
            " position at " . $this->company->name . ". We are pleased to inform you that you have been selected for an interview. </p>" .
            "<br>" .
            "<p>We would like to schedule your interview on [Date] at [Time] at our [Location]. Please confirm your availability by responding to this email or by calling [Your Phone Number].</p>" .
            "<br>" .
            "<p>We look forward to meeting you and discussing your application further.</p>" .
            "<br>" .
            "Sincerely," .
            "<br>" .
            "<p>" . $this->user->name . "</p>" .
            "<p> .[Your Title] </p>" .
            "<p>" . $this->company->name . "</p>";

        $this->dispatch('show-tinyMce');
    }


    public function render()
    {

        return view('livewire.employer.applicants.profile')->layout('components.layouts.portal');
    }
}
