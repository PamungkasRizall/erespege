<?php

namespace App\Livewire\Tables;

use App\Enums\FilingOrigin;
use App\Enums\FilingStatus;
use App\Services\UserService;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Filing;
use Illuminate\Database\Eloquent\Builder;

class AssesorReviewsTable extends DataTableComponent
{
    protected $model = Filing::class;
    public string $category;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('filings.created_at', 'desc')
            ->setFilterLayoutSlideDown();
    }

    public function builder(): Builder
    {
        $assesor_profession_id = (new UserService)->userProfessionId();

        return Filing::select(
                'filings.id',
                'filings.user_id',
                'filings.category_id',
                'start_date',
                'end_date'
            )
            ->where([
                ['status', '!=', FilingStatus::PENDING],
                ['origin', FilingOrigin::SYSTEM]
            ])
            ->with(['category', 'user.profile', 'competence.details', 'answers.choice', 'answers.assessor_choice', 'assessor'])
            ->whereHas('user.profile', function ($query) use($assesor_profession_id) {
                $query->where('profession_id', $assesor_profession_id);
            });
    }

    public function columns(): array
    {
        return [
            Column::make('User', 'user.name')
                ->sortable()
                ->searchable()
                ->format(
                    fn($value, $row, Column $column) => trim(sprintf('%s %s %s', $row->user->profile->doctoral_degree, $value, $row->user->profile->academic_degree))
                ),
            Column::make('Kompetensi', 'user.profile.functionalPosition.name')
                ->sortable()
                ->searchable(),
            Column::make('No Surat', 'letter_no')
                ->sortable()
                ->searchable()
                ->format(
                    function ($value, $row, Column $column) {
                        $html = $value;

                        // if ($row->status === FilingStatus::REVIEW) {
                        //     $html = '<a href="'. route('applications.credential.assessor-reviews.review', ['id' => $row->id]) .'" class="badge mb-1 space-x-2 bg-primary text-white dark:bg-accent">
                        //                 <span>Review Sekarang</span>
                        //             </a>';
                        // }

                        // $html = (str_starts_with($value, 'DUMMY'))
                        //     ? $row->status == FilingStatus::DONE
                        //         ? '<button wire:click="$dispatch(\'show\', { id: \'{{ $value }}\' })" class="badge mb-1 space-x-2 bg-info text-white dark:bg-accent">
                        //             <span>Update No Surat</span>
                        //            </button>'
                        //         : '<a href="'. route('assessor-reviews.review', ['id' => $row->id]) .'" class="badge mb-1 space-x-2 bg-primary text-white dark:bg-accent">
                        //             <span>Review Sekarang</span>
                        //            </a>'
                        //     : '<p class="text-primary">'. $value .'</p>';

                        $html .= '<p class="mt-0.5 text-info font-medium text-xs">'. $row->start_date->format('d/m/Y') . ' s/d ' . ($row->end_date ? $row->end_date->format('d/m/Y') : '-') .'</p>';

                        return $html;
                    }
                )
                ->html(),
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
            Column::make("Assesor", "id")
                ->searchable()
                ->sortable()
                ->format(
                    function ($value, $row) {

                        $html = $row->assessor->assesor->name ?? null;

                        if ($row->status === FilingStatus::REVIEW) {
                            $html = '<a href="'. route('applications.credential.assessor-reviews.review', ['id' => $row->id]) .'" class="badge mb-1 space-x-2 bg-primary text-white dark:bg-accent">
                                        <span>Review Sekarang</span>
                                    </a>';
                        }

                        return $html;
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
