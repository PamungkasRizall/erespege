<?php

namespace App\Livewire\Tables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Structure;
use Illuminate\Database\Eloquent\Builder;

class StructuresTable extends DataTableComponent
{
    protected $model = Structure::class;
    protected $index = 0;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            // ->setDefaultSort('name', 'asc')
            ->setFilterLayoutSlideDown()
            ->setTdAttributes(function(Column $column, $row, $columnIndex, $rowIndex) {
                $attributes = [
                    'class' => 'whitespace-nowrap-unset',
                ];

                return $attributes;
            });
    }

    public function builder(): Builder
    {
        return Structure::with('parent', 'users', 'department');
    }

    public function columns(): array
    {
        return [
            Column::make('#', 'id')
                ->format(fn () => ++$this->index +  ($this->getPage() - 1) * $this->perPage),
            Column::make("Unit", "department_id")
                ->searchable()
                ->sortable()
                ->format(
                    fn($value, $row, Column $column) => $row->department?->name
                ),
            Column::make("Nama", "name")
                ->searchable()
                ->sortable(),
            Column::make("Atasan", "parent_id")
                ->searchable()
                ->sortable()
                ->format(
                    fn($value, $row, Column $column) => $row->parent?->name
                )
                ->collapseAlways(),
            Column::make("User", "is_unique")
                ->format(
                    fn($value, $row, Column $column) => implode('', $row->users->pluck('name')->map(fn($item, $k) => '<p class="mb-0.5 text-xs text-primary">'.($row->is_unique  ? '' : ++$k . '. ') .$item.'</p>')->toArray())
                )
                ->html()
                ->collapseAlways(),
            Column::make('Aksi', 'id')
                ->format(
                    fn($value, $row, Column $column) => view('components.partials.table-actions', ['canAddUser' => 'structure-create', 'canEdit' => 'structure-create', 'canDelete' => 'structure-create'])->withValue($value)
                ),
        ];
    }
}
