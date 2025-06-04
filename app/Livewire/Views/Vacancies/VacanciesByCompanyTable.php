<?php

namespace App\Livewire\Views\Vacancies;

use App\Models\Route;
use App\Models\Vacancy;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\Rule;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class VacanciesByCompanyTable extends PowerGridComponent
{
//returns a list of vacancies for a specified company_id
//include it on view with <livewire:views.vacancies.vacancies-by-company-table company_id="$company->id"/>


    use WithExport;
    public $company_id, $route, $status;

    public function setUp(): array
    {
        $this->showCheckBox();
        $this->route = Route::where('role', '=', 'employer')
            ->where('view','employer.vacancy.applicant')
            ->first();

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
        if($this->status == 'deleted')
        {
            return Vacancy::query()
                ->join('sub_specializations', function ($fn) {
                    $fn->on('vacancies.sub_specialization_id', 'sub_specializations.id');
                })
                ->leftJoin('applicant_profile_vacancy', function ($fn) {
                    $fn->on('vacancies.id', 'applicant_profile_vacancy.vacancy_id');
                })
                ->select([
                    'vacancies.id',
                    'title',
                    'details',
                    'sub_specialization_id',
                    'sub_specializations.name as specialization',
                    'job_type',
                    'location',
                    'salary_from',
                    'salary_to',
                    'total_vacancy',
                    'vacancies.created_at',
                    'vacancies.deleted_at',
                    DB::raw('count(applicant_profile_vacancy.id) as applicant')
                ])
                ->groupBy( 'vacancies.id', 'title',
                    'details',
                    'sub_specialization_id',
                    'sub_specializations.name',
                    'job_type',
                    'location',
                    'salary_from',
                    'salary_to',
                    'total_vacancy', 'vacancies.created_at', 'vacancies.deleted_at')
                ->where('company_id', '=', $this->company_id)
                ->onlyTrashed();
        }

//        dd($this->company_id);
       return  Vacancy::query()
        ->join('sub_specializations', function ($fn) {
            $fn->on('vacancies.sub_specialization_id', 'sub_specializations.id');
        })
        ->leftJoin('applicant_profile_vacancy', function ($fn) {
            $fn->on('vacancies.id', 'applicant_profile_vacancy.vacancy_id');
        })
        ->select([
            'vacancies.id',
            'title',
            'details',
            'sub_specialization_id',
            'sub_specializations.name as specialization',
            'job_type',
            'location',
            'salary_from',
            'salary_to',
            'total_vacancy',
            'vacancies.created_at',
            DB::raw('count(applicant_profile_vacancy.id) as applicant')
        ])
        ->groupBy( 'vacancies.id', 'title',
            'details',
            'sub_specialization_id',
            'sub_specializations.name',
            'job_type',
            'location',
            'salary_from',
            'salary_to',
            'total_vacancy', 'vacancies.created_at')
        ->where('company_id', '=', $this->company_id);


    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('company_id')
            ->add('title')
            ->add('details')
            ->add('specialization')
            ->add('sub_specialization_id')
            ->add('job_type')
            ->add('location', function ($model){
                return substr($model->location, 0, 35) . '...' ;
            })
            ->add('salary', function ($model) {
                $salary = '';
                if ($model->salary_from > 0) {
                    $salary = 'Php. ' . number_format((float)$model->salary_from, 2, '.', ',');
                }

                if ($model->salary_from > 0 && $model->salary_from > 0) {
                    $salary = $salary . ' - ';
                }

                if ($model->salary_from > 0) {
                    $salary = $salary . 'Php. ' . number_format((float)$model->salary_from, 2, '.', ',');
                }

                return $salary;

            })
            ->add('total_vacancy', function ($model) {
                return number_format($model->total_vacancy, 0, '', ',');
            })
            ->add('created_at_formatted', function ($model){
                return Carbon::parse($model->created_at)->format('M d, Y');
            })
            ->add('applicant');
    }

    public function columns(): array
    {
        return [

            Column::make('Title', 'title')
                ->sortable()
                ->searchable(),

            Column::make('Total Applicant', 'applicant')
                ->sortable()
                ->searchable(),

//            Column::make('Specialization', 'specialization')
//                ->sortable()
//                ->searchable(),

            Column::make('Job type', 'job_type')
                ->sortable()
                ->searchable(),

            Column::make('Place of assignment', 'location')
                ->sortable()
                ->searchable(),

            Column::make('Salary', 'salary')
                ->sortable()
                ->searchable(),


            Column::make('Total vacancy', 'total_vacancy')
                ->sortable()
                ->searchable(),

            Column::make('Date posted', 'created_at_formatted')
                ->sortable()
                ->searchable(),


            Column::action('Action')];
    }

    public function filters(): array
    {
        return [
        ];
    }

    public function actions($row): array
    {
        return [
            Button::add('view')
                ->slot('<x-awesome.view></x-awesome.view>')
                ->class('pointer pointer-danger')
                ->route($this->route->route, [ $row->id] ),
            Button::add('edit')
                ->slot('<x-awesome.edit></x-awesome.edit>')
                ->class('pointer pointer-primary')
                ->dispatch('edit', ['rowId' => $row]),
            Button::add('delete')
                ->slot('<x-awesome.trash></x-awesome.trash>')
                ->class('pointer pointer-danger')
                ->dispatch('confirmDelete', ['rowId' => $row]),

//            Button::add('archive')
//                ->slot('<x-awesome.trash></x-awesome.trash>')
//                ->class('pointer pointer-danger')
//                ->route($this->route->route, [ $row->id] ),
        ];
    }

    public function header(): array
    {

        return [
            Button::add('Add')
                ->slot('<x-awesome.add></x-awesome.add>')
                ->class('btn btn-sm btn-primary')
                ->dispatch('add', [])
        ];
    }

    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
           Rule::button('edit')
               ->when(fn($row) => $row->applicant > 0)
               ->hide(),
           Rule::button('edit')
               ->when(fn($row) => $this->status == 'deleted')
               ->hide(),
           Rule::button('delete')
               ->when(fn($row) => $this->status == 'deleted')
               ->hide(),
           Rule::button('view')
               ->when(fn($row) => $row->applicant <= 0)
               ->hide(),
        ];
    }

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
