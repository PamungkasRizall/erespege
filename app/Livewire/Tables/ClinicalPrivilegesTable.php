<?php

namespace App\Livewire\Tables;

use App\Enums\FilingOrigin;
use App\Enums\FilingStatus;
use App\Services\UserService;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Filing;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class ClinicalPrivilegesTable extends DataTableComponent
{
    protected $model = Filing::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('filings.created_at', 'desc')
            ->setFilterLayoutSlideDown();
    }

    public function builder(): Builder
    {
        $userCommittee = (new UserService)->userCommittee();

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
            ->whereHas('user.profile.profession', function ($query) use($userCommittee) {
                $query->where('committee', $userCommittee);
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
                        $currentUser = $row->user_id === Auth::id();

                        $subCommittee = (new UserService)->isPosition('sub komite');
                        $headOfCommittee = (new UserService)->isPosition('ketua komite');

                        if ($row->status === FilingStatus::SUB_COMMITTEE && $subCommittee && !$currentUser) {
                            $html = '<button wire:click="$dispatch(\'modalSubCommittee\', { id: \''.$row->id.'\' })" class="badge mb-1 space-x-2 bg-primary text-white dark:bg-accent">
                                        <span>Review Sekarang</span>
                                    </button>';
                        }

                        if ($row->status === FilingStatus::HEAD_OF_COMMITTEE && $headOfCommittee && !$currentUser) {
                            $html = '<button wire:click="$dispatch(\'modalHeadOfCommittee\', { id: \''.$row->id.'\' })" class="badge mb-1 space-x-2 bg-primary text-white dark:bg-accent">
                                        <span>Review Sekarang</span>
                                    </button>';
                        }

                        if ($row->status === FilingStatus::PEMBERKASAN && $subCommittee && !$currentUser) {
                            $html = '<button wire:click="$dispatch(\'modalClinicalPrivilages\', { id: \''.$row->id.'\' })" class="badge mb-1 space-x-2 bg-primary text-white dark:bg-accent">
                                        <span>Clinical Privilages</span>
                                    </button>';
                        }

                        if ($row->status === FilingStatus::DIRECTOR && $subCommittee && !$currentUser) {
                            $html = '<button wire:click="$dispatch(\'modalUploadFile\', { id: \''.$row->id.'\' })" class="badge mb-1 space-x-2 bg-primary text-white dark:bg-accent">
                                        <span>Upload Berkas</span>
                                    </button>';
                        }

                        if ($row->status === FilingStatus::DONE) {
                            $html = '<a href="'.$row->hyperlink.'" target="_blank" class="text-info font-semibold" x-tooltip.primary="\'Pemberkasan PDF\'">
                                        '.$value.'
                                    </a>';
                        }

                        $html .= '<p class="mt-0.5 font-medium text-xs">'. $row->start_date->format('d/m/Y') . ' s/d ' . ($row->end_date ? $row->end_date->format('d/m/Y') : '-') .'</p>';

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

                        return "<div class=\"badge bg-{$color}/10 text-{$color} dark:bg-{$color}/15\">
                                    {$text}
                                </div>";
                    }
                )
                ->html(),
            Column::make("Assesor", "id")
                ->searchable()
                ->sortable()
                ->format(
                    function ($value, $row) {

                        $html = $row->assessor->assesor->name ?? null;

                        if ($row->status === FilingStatus::REVIEW && Auth::user()->can('assessor-create')) {
                            $html = '<a href="'. route('applications.credential.assessor-reviews.review', ['id' => $row->id]) .'" class="badge mb-1 space-x-2 bg-primary text-white dark:bg-accent">
                                        <span>Review Sekarang</span>
                                    </a>';
                        }

                        return $html;
                    }
                )
                ->html(),
            Column::make("", "id")
                ->searchable()
                ->sortable()
                ->format(
                    function ($value, $row)
                    {
                        if ($row->status->value > FilingStatus::SUB_COMMITTEE->value)
                        {
                            return '
                                <button wire:click="$dispatch(\'modalPrintDoneAll\', { id: \''.$row->id.'\' })"  x-tooltip.primary="\'Pemberkasan PDF\'"  class="btn h-6 w-8 p-0 text-primary hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mt-px h-4.5 w-4.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" />
                                    </svg>
                                </button>
                            ';
                        } else {
                            return '';
                        }
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

    public function filters(): array
    {
        return [
            SelectFilter::make('Status')
                ->setFilterPillTitle('Status')
                ->options(['' => 'All'] + FilingStatus::values())
                ->filter(function(Builder $builder, string $value) {
                    if($value)
                    {
                        $status = FilingStatus::from($value);
                        $builder->where('status', $status);
                    }
                }),
        ];
    }
}
