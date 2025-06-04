<?php

namespace App\Livewire\Applicant\Jobs\Search;

use Carbon\Carbon;
use App\Models\Vacancy;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use App\Models\Specialization;
use App\Models\SubSpecialization;
use Illuminate\Http\Request;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    #[Url]
    public $vacancyId, $search, $specialization = [], $type, $company, $salaryRange = 0, $salaryRangeTo, $listed;

    public $vacancy;
    public $specializations;
    public $perPage = 7;
    public $isMobile = false;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    // #[On('load-more')]
    public function loadMore()
    {
        $this->perPage = $this->perPage + 7;
    }

    #[On('removeVacancy')]
    public function removeVacancy(){
        $this->vacancy = null;
        $this->vacancyId = null;
    }

    public function getVacancyDetails($id)
    {
        $this->vacancyId = $id;
    }

    public function mount(Request $request){
        $this->specializations = Specialization::with('SubSpecialization')->get();
      

        $userAgent = $request->header('User-Agent');
        $this->isMobile = preg_match('/iPad|Tablet|Kindle|Silk|Mobile|Android|iPhone|iPod|BlackBerry|Windows Phone/', $userAgent);
        // dd($this->screenType);
    }

    public function render()
    {
        if($this->vacancyId){
            $this->vacancy = Vacancy::find($this->vacancyId);
        }

        $search = '%' . $this->search . '%';

        if($this->type == 'All types of job' || empty($this->type)){
            $type = null;
        }else{
            $type = ucWords($this->type);
        }

        if($this->listed == 'Any time' || empty($this->listed)){
            $listed = null;
        }else if($this->listed == "Today"){
            $listed = Carbon::now();
        }else if($this->listed == 'last 3 days'){
            $listed = Carbon::now()->subDays(3)->startOfDay();
        }else if($this->listed == 'last 7 days'){
            $listed = Carbon::now()->subDays(7)->startOfDay();
        }else if($this->listed == 'last 14 days'){
            $listed = Carbon::now()->subDays(14)->startOfDay();
        }else if($this->listed == 'last 30 days'){
            $listed = Carbon::now()->subDays(30)->startOfDay();
        }

        $salaryRange = $this->salaryRange;
        $specialization = $this->specialization;

        if ($this->salaryRangeTo == '0') {
            $salaryRangeTo = null;
        }else{
            $salaryRangeTo = $this->salaryRangeTo;
        }

        if ($this->search != null) {
            $results = Vacancy::orderby('created_at', 'desc')
                ->when($this->search, function ($query) use ($search) {
                    $query->where(function($q) use($search){
                        $q->where('title', 'like', $search)
                        ->orWhereRelation('company', 'name', 'like', $search);
                    });
                })
                ->with('company')

                ->when($type, function ($query) use ($type) {
                    $query->where('job_type', $type);
                })
                ->when($listed, function ($query) use ($listed) {
                    $query->whereBetween('created_at', [$listed, Carbon::now()->startOfDay()] );
                })
                ->when($salaryRange, function ($query) use ($salaryRange) {
                    $query->where('salary_from', '>=', $salaryRange);
                })
                ->when($salaryRangeTo, function ($query) use ($salaryRangeTo) {
                    $query->where('salary_to', '<=', $salaryRangeTo);
                })
                ->when($specialization, function ($query) use ($specialization) {
                    $query->whereIn('sub_specialization_id', $specialization);
                })
                ->paginate($this->perPage);

                if($results->count() <= 0){
                    $this->vacancy = null;
                }
        } else {
            $results = Vacancy::orderby('created_at', 'desc')->paginate($this->perPage);
//            $this->vacancy = null;
        }
        return view('livewire.applicant.jobs.search.index', ['results' => $results]);
    }
}
