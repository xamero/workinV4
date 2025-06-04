<?php

namespace App\Livewire\Views\Applicants;

use App\Models\EmployerProfile;
use App\Models\Route;
use App\Models\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class ApplicantsByVacancyTable extends PowerGridComponent
{
//returns a list of applicants for a specified vacancy_id
//include it on view with <livewire:views.applicants.all-applicants-table :vacancy_id="$vacancy->id"/>

    use WithExport;

    public $vacancy_id, $employer_profile, $route, $company_id;

    public function setUp(): array
    {
        $this->showCheckBox();
        $this->route = Route::where('role', '=', Auth::user()->getRoleNames()->first())
            ->where('view','vacancy.applicant.profile')
            ->first();
        $this->route = $this->route->route;
        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
      
        if($this->vacancy_id != 0)
        {
            return DB::table('applicant_profile_vacancy as apv')
                ->join('applicant_profiles as ap', function ($fn) {
                    $fn->on('apv.applicant_profile_id', 'ap.id');
                })
                ->join('vacancies as v', function ($fn){
                    $fn->on('apv.vacancy_id', 'v.id');
                })

                ->where('apv.vacancy_id', $this->vacancy_id)
                ->select([
                    'apv.id', 'apv.vacancy_id', 'apv.applicant_profile_id', 'ap.firstname', 'ap.midname', 'ap.surname', 'ap.suffix',
                    'apv.applied_at', 'apv.status'
                ]);
        }else{
            return DB::table('applicant_profile_vacancy as apv')
                ->join('applicant_profiles as ap', function ($fn) {
                    $fn->on('apv.applicant_profile_id', '=', 'ap.id');
                })
                ->join('vacancies as v', function ($fn) {
                    $fn->on('apv.vacancy_id', '=', 'v.id');
                })
                ->select([
                    'apv.id',
                    'apv.vacancy_id',
                    'apv.applicant_profile_id',
                    'ap.firstname',
                    'ap.midname',
                    'ap.surname',
                    'ap.suffix',
                    'apv.applied_at',
                    'apv.status'
                ])
                ->where('v.company_id', $this->company_id); // Filtering by company_id
        }

        return 0;

    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('applicant_profile_id')
            ->add('applied_at_formatted', function ($model) {
                return  date('M. d, Y', strtotime( $model->applied_at));
            })
            ->add('status', function ($model){
                $item = '';
                if($model->status == 1)
                {
                    $item = '<span class="badge bg-success">✓</span>';
                }elseif($model->status == 2){
                $item = '<span class="badge bg-danger">X</span>';
                   
                }else{
                $item = '<span class="badge bg-warning">O</span>';
                }
                return $item;
            })
            ->add('fullname', function ($model) {
                return $model->surname . ', ' . $model->firstname . ' ' . $model->midname;
            })
            ->add('created_at')
            ->add('updated_at');
    }

    public function columns(): array
    {
        return [
//            Column::make('Id', 'id'),
//            Column::make('Applicant profile id', 'applicant_profile_id'),
            Column::make('Name', 'fullname')
                ->searchable()
                ->sortable(),
            Column::make('Date Applied', 'applied_at_formatted')
                ->sortable(),

            Column::make('Status', 'status')
                ->sortable()
                ->searchable(),

            Column::action('Action')

        ];
    }

    public function filters(): array
    {
        return [
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert('.$rowId.')');
    }

    public function actions($row): array
    {
        return [
            Button::add('view')
//                ->slot('Edit')
                ->render(function($model)
                {
                    return Blade::render(<<<HTML
                    <a wire:navigate class="pointer" href="{{route('$this->route',['vacancy_id' => $model->vacancy_id, 'applicant_id' => $model->applicant_profile_id])}}"><x-awesome.view></x-awesome.view></a>
                HTML);
                })


//            Button::add('view')
//                ->slot('<x-awesome.view></x-awesome.view>')
//                ->id()
//                ->class('pointer')
//                ->dispatch('edit', ['rowId' => $row->id])
        ];
    }

    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */

    protected function getListeners()
    {
        return array_merge(
            parent::getListeners(),
            [
                'RefreshComponent' => '$refresh',
            ]
        );
    }
}
