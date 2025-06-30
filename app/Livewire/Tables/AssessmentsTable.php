<?php

namespace App\Livewire\Tables;

use App\Enums\FilingOrigin;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Filing;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class AssessmentsTable extends DataTableComponent
{
    protected $model = Filing::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('start_date', 'desc')
            ->setFilterLayoutSlideDown();
    }

    public function builder(): Builder
    {
        return Filing::select('filings.id', 'category_id', 'end_date', 'user_id')
            ->where([
                ['user_id', Auth::user()->id],
                ['origin', FilingOrigin::SYSTEM]
            ])
            ->with('competence.functionalPosition', 'competence.details', 'answers.choice', 'answers.assessor_choice');
    }

    public function columns(): array
    {
        return [
            Column::make('Jabatan Fungsional', 'competence.functionalPosition.name')
                ->sortable()
                ->searchable(),
            Column::make('No Surat', 'letter_no')
                ->sortable()
                ->searchable()
                ->format(
                    fn($value, $row, Column $column) => '<a class="text-primary" href="'. $row->hyperlink .'" target="_blank">'. $value .'</a>'
                )
                ->html(),
            Column::make("Masa Berlaku", "start_date")
                ->format(
                    fn($value, $row, Column $column) => $row->end_date ? $value->format('d/m/Y') . ' s/d ' . $row->end_date->format('d/m/Y') : 'Seumur Hidup'
                )
                ->sortable(),
            Column::make("Status")
                ->searchable()
                ->sortable()
                ->format(
                    function ($value) {
                        $color = $value->color();
                        $text = $value->naming();

                        return '<div class="badge bg-'. $color .'/10 text-'. $color .' dark:bg-'. $color .'/15">
                                    '. $text .'
                                </div>';
                    }
                )
                ->html(),
            Column::make("Rincian Kewenangan Klinis (RKK)", "competence_id")
                ->format(
                    fn($value, $row) => view('livewire.master.competences.list-details', ['details' => $row->competence->details, 'showAnswerColumn' => $row->answers])
                )
                ->collapseAlways(),
        ];
    }
}
