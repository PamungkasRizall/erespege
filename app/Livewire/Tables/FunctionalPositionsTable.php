<?php

namespace App\Livewire\Tables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\FunctionalPosition;
use App\Services\ProfessionService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class FunctionalPositionsTable extends DataTableComponent
{
    protected $model = FunctionalPosition::class;
    protected $index = 0;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setFilterLayoutSlideDown();
    }

    public function columns(): array
    {
        return [
            Column::make('#', 'id')
                ->format(fn () => ++$this->index +  ($this->getPage() - 1) * $this->perPage),
            Column::make("Nama", "name")
                ->sortable(),
            Column::make("Profesi", "profession.name")
                ->sortable(),
            Column::make("Tgl Dibuat", "created_at")
                ->format(
                    fn($value, $row, Column $column) => Carbon::make($value)->format('d/m/y H:i:s')
                )
                ->sortable(),
            // Column::make("Dibuat Oleh", "user.name")
            //     ->searchable()
            //     ->sortable(),
            Column::make('Aksi', 'id')
                ->format(
                    fn($value, $row, Column $column) => view('components.partials.table-actions', ['canEdit' => 'functional-positions-list', 'canDelete' => 'functional-positions-list'])->withValue($value)
                ),
        ];
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Profesi')
                ->setFilterPillTitle('Unit')
                ->options(
                    (new ProfessionService)->getProfessions()
                        ->put('', '-- All --')
                        ->sort()
                        ->toArray()
                )
                ->filter(function(Builder $builder, string $value) {
                    if($value)
                        $builder->where('profession_id', $value);
                }),
        ];
    }
}
