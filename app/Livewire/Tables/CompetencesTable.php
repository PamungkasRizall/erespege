<?php

namespace App\Livewire\Tables;

use App\Enums\Committee;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Competence;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class CompetencesTable extends DataTableComponent
{
    protected $model = Competence::class;
    protected $index = 0;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setFilterLayoutSlideDown();
    }

    public function builder(): Builder
    {
        return Competence::with('functionalPosition.profession')
            ->whereHas('functionalPosition.profession', function ($query) {
                $query->where('committee', authUserCommittee());
            });
    }

    public function columns(): array
    {
        return [
            Column::make('#', 'id')
                ->format(fn () => ++$this->index +  ($this->getPage() - 1) * $this->perPage),
            Column::make("Kode Buku", "code")
                ->searchable()
                ->sortable(),
            Column::make("Professi", "functional_position_id")
                ->searchable()
                ->sortable()
                ->format(
                    fn($value, $row) => $row->functionalPosition->profession->name
                ),
            Column::make("Jabatan Fungsional", "functional_position_id")
                ->searchable()
                ->sortable()
                ->format(
                    fn($value, $row) => $row->functionalPosition->name
                ),
            Column::make("Status", "active")
                ->searchable()
                ->sortable()
                ->format(
                    function ($value, $row) {
                        $txtColor = $value ? 'success' : 'error';
                        $tooltip = $value ? 'Non ' : '';

                        return '<button wire:click="$dispatch(\'activation\', { id: \''. $row->id .'\' })" class="cursor-pointer badge bg-'.$txtColor.'/10 py-1 px-1.5 text-'.$txtColor.' dark:bg-'.$txtColor.'-light/15 dark:text-'.$txtColor.'-light" x-tooltip.primary="\''.$tooltip.'Aktifkan ?\'">
                                    '. ($value ? 'Aktif' : 'Tidak Aktif') .'
                                </button>';
                    }
                )
                ->html(),
            Column::make("Tgl Dibuat", "created_at")
                ->sortable(),
            Column::make("Rincian Kewenangan Klinis (RKK)", "id")
                ->format(
                    fn($value, $row) => view('livewire.master.competences.list-details', ['details' => $row->details, 'choices' => $row->choices])
                )
                ->collapseAlways(),
        ];
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Status')
                ->setFilterPillTitle('Status')
                ->options(['' => '-- All --', true => 'Aktif', false => 'Tidak Aktif'])
                ->filter(function(Builder $builder, string $value) {
                    if($value)
                    {
                        $builder->where('active', $value);
                    }
                }),
        ];
    }
}
