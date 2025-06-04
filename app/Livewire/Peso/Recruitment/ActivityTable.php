<?php

namespace App\Livewire\Peso\Recruitment;

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
use Illuminate\Support\Str;

final class ActivityTable extends PowerGridComponent
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
        return DB::table('recruitment_activities')
            ->select(
                'recruitment_activities.id',
                'type',
                'start',
                'end',
                'venue',
                'details',
                DB::raw('GROUP_CONCAT(companies.name SEPARATOR ", ") as related_companies')
            )
            ->join('company_recruitment_activity', 'recruitment_activities.id', '=', 'company_recruitment_activity.recruitment_activity_id')
            ->join('companies', 'company_recruitment_activity.company_id', '=', 'companies.id')
            ->groupBy('recruitment_activities.id', 'type', 'start', 'end', 'venue','details');
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('type')
            ->add('start_formatted', fn($model) => Carbon::parse($model->start)->format('d/m/Y H:i'))
            ->add('end_formatted', fn($model) => Carbon::parse($model->end)->format('d/m/Y H:i'))
            ->add('related_companies_formatted', fn($model) => Str::limit($model->related_companies, 75))
            ->add('venue')
            ->add('details');

    }

    public function columns(): array
    {
        return [
            Column::make('Type', 'type')
                ->sortable()
                ->searchable(),

            Column::make('Start', 'start_formatted', 'start')
                ->sortable(),

            Column::make('End', 'end_formatted', 'end')
                ->sortable(),
            Column::make('Venue', 'venue')
                ->sortable()
                ->searchable(),

            Column::make('Participating Companies', 'related_companies_formatted')
                ->sortable()
                ->searchable(),

            Column::action('Action'),
        ];
    }

    public function filters(): array
    {
        return [
            Filter::datetimepicker('start'),
            Filter::datetimepicker('end'),
        ];
    }

    public function header(): array
    {

        return [
            Button::add('Add')
                ->slot('<x-awesome.add></x-awesome.add>')
                ->class('btn  btn-primary')
                ->dispatch('add', [])
        ];
    }


    public function actions($row): array
    {
        return [
            Button::add('view')
                ->slot('<x-awesome.view></x-awesome.view>')
                ->class('pointer pointer-success')
                ->dispatch('view', ['rowId' => $row]),
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
