<?php

namespace App\Livewire\Views\Company;

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

final class AllCompaniesTable extends PowerGridComponent
{
    use WithExport;

    public function setUp(): array
    {
        $this->showCheckBox();

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
        return DB::table('companies')
            ->leftJoin('vacancies', function ($fn) {
                $fn->on('vacancies.company_id', 'companies.id');
            })
            ->select([
                'companies.id',
                'name',
                'email',
                'address',
                'contact_number',
                'logo',
                'company_overview',
                'company_code',
                DB::raw('count(vacancies.id) as vacancies')
            ])
            ->groupBy('companies.id','name', 'email','address','contact_number', 'logo', 'company_overview','company_code')
            ->orderBy('name');
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
//            ->add('user_id')
            ->add('name', function ($model){
                return substr($model->name, 0, 20) . '...' ;
            })
            ->add('email')
            ->add('address', function ($model){
                return substr($model->address, 0, 25) . '...' ;
            })
            ->add('contact_number')
            ->add('logo', function ($model){
                return '<img src="' . asset("storage/company/{$model->logo}") . '" style="max-width:50px" >';
            })
            ->add('company_overview')
            ->add('created_at')
            ->add('updated_at')
            ->add('deleted_at')
            ->add('company_code')
            ->add('vacancies');
    }

    public function columns(): array
    {
        return [

            Column::make('Logo', 'logo')
                ->sortable()
                ->searchable(),
            Column::make('Company code', 'company_code')
                ->sortable()
                ->searchable(),

            Column::make('Name', 'name')
                ->sortable()
                ->searchable(),

            Column::make('Email', 'email')
                ->sortable()
                ->searchable(),

            Column::make('Address', 'address')
                ->sortable()
                ->searchable(),

            Column::make('Contact number', 'contact_number')
                ->sortable()
                ->searchable(),
            Column::make('Vacancies', 'vacancies')
                ->sortable()
                ->searchable(),


//            Column::make('Company overview', 'company_overview')
//                ->sortable()
//                ->searchable(),


            Column::action('Action')

        ];
    }

    public function filters(): array
    {
        return [
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


    public function actions($row): array
    {
        return [
            Button::add('edit')
                ->slot('<x-awesome.edit></x-awesome.edit>')
                ->class('pointer pointer-primary')
                ->dispatch('edit', ['rowId' => $row]),
            Button::add('delete')
                ->slot('<x-awesome.trash></x-awesome.trash>')
                ->class('pointer pointer-danger')
                ->dispatch('delete', ['rowId' => $row]),
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
