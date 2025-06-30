<?php

namespace App\Livewire\Applications\Credential;

use App\Enums\FilingStatus;
use App\Models\Filing;
use App\Services\FilingService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use App\Traits\{Loggable, NotificationTypes, WithNotification};
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Assessments extends Component
{
    use AuthorizesRequests, NotificationTypes, Loggable, WithNotification;

    private const TEST_MINUTES = 120;

    public string $meta_title = '';

    public ?Filing $lastCredential;
    public bool $assessmentOnPeriod = false;
    public bool $isDocumentCompleted = false;
    public bool $isDocumentApproved = false;

    public Collection $existingDocuments;

    private FilingService $filingService;

    public function boot(
        FilingService $filingService,
    )
    {
        $this->filingService = $filingService;
    }

    public function mount()
    {
        $this->authorize('credential-assessment');
        $this->initializeData();
    }

    private function initializeData(): void
    {
        $this->loadMetaData();

        $this->lastCredential = $this->filingService->getLastCredential();
        $this->existingDocuments = $this->filingService->getUserFilingsByOrigin(Auth::id());

        $this->isDocumentCompleted = $this->existingDocuments->count() === Filing::NUMBER_REQ_DOCUMENT;
        $this->isDocumentApproved = $this->existingDocuments?->first()?->status === FilingStatus::DONE;

        $this->checkAssessmentOnPeriod();
    }

    private function loadMetaData(): void
    {
        $this->meta_title = 'Assesmen Kredensial';
    }

    public function render()
    {
        return view('livewire.applications.credential.assessments')
            ->layoutData([
                'title' => $this->meta_title,
                'isSidebarOpen' => 'true',
                'isHeaderBlur' => 'true'
            ]);
    }

    private function checkAssessmentOnPeriod()
    {
        if ($this->lastCredential?->status === FilingStatus::DONE) //done
            $this->assessmentOnPeriod = $this->filingService->assessmentOnPeriod($this->lastCredential);

        if ($this->assessmentOnPeriod)
            $this->removeDocuments();
    }

    private function removeDocuments()
    {
        $str_code = $this->existingDocuments->first(fn ($filing) => Str::contains($filing->name, 'Surat Tanda Register'))->letter_no;
        if($str_code !== $this->lastCredential->str_code)
            return false;

        try {
            foreach($this->existingDocuments as $filing)
                $this->filingService->deleteFiling($filing->id);

        } catch(Exception $e) {
            $this->handleError($e, 'remove document');
        }
    }
}
