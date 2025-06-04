<?php

namespace App\Livewire\Applicant\Company;

use App\Models\Company;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Collection;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    #[Url]
    public $search, $companyId;
    public $company;
    public $perPage = 15;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function loadMore()
    {
        $this->perPage = $this->perPage + 9;
    }

    public function getCompanyDetails($id)
    {
        $this->companyId = $id;
    }

    public function removeCompany(){
        $this->company = null;
        $this->companyId = null;
    }

    public function render()
    {
        if($this->companyId){
            $this->company = Company::find($this->companyId);
        }

        $search = '%' . $this->search . '%';

        if ($this->search != null) {
            $results = Company::orderby('name', 'desc')
                ->when($this->search, function ($query) use ($search) {
                    $query->where('name', 'like', $search);
                })
                ->paginate($this->perPage);

            if(sizeof($results) == 0 )
            {
                $this->removeCompany();
            }
        } else {
            $results = Company::orderby('name', 'desc')->paginate($this->perPage);
        }

        return view('livewire.applicant.company.index', ['results' => $results]);
    }
}
