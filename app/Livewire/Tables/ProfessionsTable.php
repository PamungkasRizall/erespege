<?php

namespace App\Livewire\Tables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Profession;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class ProfessionsTable extends DataTableComponent
{
    protected $model = Profession::class;
    protected $index = 0;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('name', 'asc')
            ->setFilterLayoutSlideDown();
    }

    public function builder(): Builder
    {
        return Profession::with('assesors');
    }

    public function columns(): array
    {
        return [
            Column::make('#', 'id')
                ->format(fn () => ++$this->index +  ($this->getPage() - 1) * $this->perPage),
            // Column::make("Komite", "committee")
            //     ->sortable()
            //     ->format(
            //         fn($value, $row, Column $column) => $value->label()
            //     ),
            Column::make("Nama", "name")
                ->searchable()
                ->sortable(),
            Column::make("Assesor", "id")
                ->format(
                    fn($value, $row, Column $column) => implode('', $row->assesors->pluck('name')->map(fn($item, $k) => '<p class="mb-0.5 text-xs text-primary">'.++$k.'. '.$item.'</p>')->toArray())
                )
                ->html(),
            Column::make('Aksi', 'id')
                ->format(
                    fn($value, $row, Column $column) => view('components.partials.table-actions', ['canEdit' => 'professions-create', 'canDelete' => 'professions-create'])->withValue($value)
                ),
        ];
    }
}
