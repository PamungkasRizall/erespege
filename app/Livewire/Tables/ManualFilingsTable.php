<?php

namespace App\Livewire\Tables;

use App\Enums\FilingOrigin;
use App\Enums\FilingStatus;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Filing;
use App\Services\UserService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class ManualFilingsTable extends DataTableComponent
{
    protected $model = Filing::class;
    public Collection $categories;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            // ->setDefaultSort('start_date', 'desc')
            ->setFilterLayoutSlideDown();
    }

    public function builder(): Builder
    {
        $userCommittee = (new UserService)->userCommittee();

        return Filing::select('filings.user_id')
            ->where([
                ['status', FilingStatus::SUB_COMMITTEE],
                ['origin', FilingOrigin::MANUAL]
            ])
            ->with(['user.profile', 'documents', 'reCredential'])
            ->whereHas('user.profile.profession', fn($query) => $query->where('committee', $userCommittee))
            ->groupBy('filings.user_id');
    }

    public function columns(): array
    {
        return [
            Column::make('Nama', 'user.name')
                ->sortable()
                ->searchable(),
            Column::make('NIP', 'user.nip')
                ->sortable()
                ->searchable(),
            Column::make('Kompetensi', 'user.profile.functionalPosition.name')
                ->sortable()
                ->searchable(),
            Column::make('Tipe', 'user.id')
                ->sortable()
                ->searchable()
                ->format(function ($value, $row) {
                    $color = $row->reCredential ? 'error' : 'info';
                    $text = $row->reCredential ? 're-Kredensial' : 'Kredensial Awal';

                    return '
                        <div
                            class="badge border border-'.$color.' text-'.$color.'"
                        >
                            '.$text.'
                        </div>
                    ';
                })
                ->html(),
            Column::make('Persetujuan', 'user.id')
                ->sortable()
                ->searchable()
                ->format(function ($value, $row) {
                    $isComplete = Filing::NUMBER_REQ_DOCUMENT === $row->documents->count();
                    $isCurrentUser = $value === Auth::id();

                    $btnApprove = '<button wire:click="$dispatch(\'modalApprove\', { id: \''. $value .'\' })" class="badge mb-1 space-x-2 bg-primary text-white dark:bg-accent"><span>Download & Approve?</span></button>';

                    if ($isComplete) {
                        return $isCurrentUser
                            ? '<div class="badge bg-warning/10 text-warning dark:bg-warning/15">Menunggu Persetujuan</div>'
                            : $btnApprove;
                    } else {
                        return '<div class="badge bg-error/10 text-error dark:bg-error/15">Belum Lengkap</div>';
                    }

                    // return $row->reCredential
                    //     ? '<div class="badge bg-error/10 text-error dark:bg-error/15">Belum Lengkap</div>'
                    //     : $btnApprove;
                })
                ->html(),
            Column::make("Dokumen", "user.id")
                ->format(
                    fn($value, $row) => view('livewire.applications.filing.table', ['categories' => $this->categories, 'filings' => $row->documents])
                )
                ->collapseAlways(),
        ];
    }
}
