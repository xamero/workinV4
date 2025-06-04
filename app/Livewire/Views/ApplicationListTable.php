<?php

namespace App\Livewire\Views;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;
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

final class ApplicationListTable extends PowerGridComponent
{
    use WithExport;
    public string $primaryKey = 'apv.id';
    public string $sortField = 'apv.id';

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput()->showToggleColumns(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return DB::table('applicant_profile_vacancy as apv')
            ->join('vacancies as v', 'apv.vacancy_id', '=', 'v.id')
            ->join('companies as c', 'v.company_id', '=', 'c.id')
            ->select('apv.id',
                'v.title as vacancy',
                'c.name as company',
                DB::raw('count(apv.id) as counter'),
                'v.created_at as date_posted'
            )
            ->where('v.deleted_at', '=', null)
            ->groupBy('v.id', 'apv.id', 'v.title', 'c.name', 'v.created_at');
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('vacancy')
            ->add('company')
            ->add('counter')
            ->add('date_posted', function ($model)
            {
                return date('M. d, Y', strtotime($model->date_posted));
            })
            ;
    }

    public function columns(): array
    {
        return [

            Column::make('Vacancy', 'vacancy')
                ->sortable()
                ->searchable(),
            Column::make('Company', 'company')
                ->sortable()
                ->searchable(),
            Column::make('Total Applications Received', 'counter')
            ->sortable()
            ->searchable(),
            Column::make('Vacancy Posting Date', 'date_posted')
                ->sortable()
                ->searchable(),
            Column::action('Action')

        ];
    }

    public function filters(): array
    {
        return [
            Filter::inputText('vacancy'),
            Filter::inputText('company'),
            Filter::datepicker('date_posted', 'v.created_at')
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
            Button::add('edit')
                ->slot('Edit: '.$row->id)
                ->id()
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->dispatch('edit', ['rowId' => $row->id])
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
}
