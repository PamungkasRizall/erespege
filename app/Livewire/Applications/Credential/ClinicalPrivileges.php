<?php

namespace App\Livewire\Applications\Credential;

use App\DTOs\ApprovalDTO;
use App\Enums\FilingStatus;
use App\Http\Requests\ClinicalPrivilegesRequest;
use App\Models\Filing;
use App\Services\CompetenceBAService;
use App\Services\FilingService;
use App\Services\UserService;
use App\Traits\{Loggable, NotificationTypes, WithNotification};
use Carbon\Carbon;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\UploadedFile;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class ClinicalPrivileges extends Component
{
    use AuthorizesRequests, NotificationTypes, Loggable, WithNotification, WithFileUploads;

    public string $meta_title = '';
    public ?string $modelId = null;
    public bool $isSubCommittee = false;

    //Sub Committe
    public ?string $notes = null;

    //Head Of Committee
    public ?string $recomendation_code = null;
    public Carbon $recomendation_at;

    //Clinical Privileges
    public ?string $letter_no = null;
    public Carbon $cp_at;

    //DONE
    public ?UploadedFile $file = null;

    private UserService $userService;
    private CompetenceBAService $competenceBAService;
    private FilingService $filingService;

    private ClinicalPrivilegesRequest $clinicalPrivilegesRequest;

    protected $listeners = [
        'modalSubCommittee',
        'modalHeadOfCommittee',
        'modalClinicalPrivilages',
        'modalUploadFile',
        'modalPrintDoneAll'
    ];

    public function boot(
        UserService $userService,
        CompetenceBAService $competenceBAService,
        FilingService $filingService,
    )
    {
        $this->userService = $userService;
        $this->competenceBAService = $competenceBAService;
        $this->filingService = $filingService;

        $this->clinicalPrivilegesRequest = new ClinicalPrivilegesRequest();
    }

    public function mount()
    {
        $this->authorize('clinical-privileges-list');
        $this->initializeData();
    }

    private function initializeData(): void
    {
        $this->loadMetaData();

        $this->recomendation_at = Carbon::now();
    }

    private function loadMetaData(): void
    {
        $this->meta_title = 'Status Kewenangan Klinis';
        $this->meta_title .= $this->userService->isPosition('ketua komite')
            ? ' - Ketua Komite'
            : ' - Sub Komite';
    }

    public function render()
    {
        return view('livewire.applications.credential.clinical-privileges.index')
            ->layoutData([
                'title' => $this->meta_title,
                'isSidebarOpen' => 'false',
                'isHeaderBlur' => 'true'
            ]);
    }

    public function modalSubCommittee(string $id)
    {
        $this->modelId = $id;
        $this->isSubCommittee = true;

        $this->dispatch('open-modal', modalKey: 'review');
    }

    public function approvalSubCommittee()
    {
        try {

            $competenceBA = $this->competenceBAService->getBAByFilingId($this->modelId);

            $dto = ApprovalDTO::fromObject([
                'status'   => 1,
                'notes'       => $this->notes,
            ]);
            $this->competenceBAService->storeApprovalSubCommitte($competenceBA, $dto);

            $this->handleSuccess();
            $this->notes = null;

        } catch(Exception $e) {
            $this->handleError($e, 'store approval');
        }
    }

    public function modalHeadOfCommittee(string $id)
    {
        $this->modelId = $id;
        $this->isSubCommittee = false;

        $this->dispatch('open-modal', modalKey: 'review-ketua');
    }

    public function approvalHeadOfCommittee()
    {
        $this->validateHeadOfCommittee();

        try {

            $filing = $this->filingService->findOrFail($this->modelId);

            $dto = ApprovalDTO::fromObject([
                'status' => 1,
                'notes' => $this->notes,
                'recomendation_code' => $this->recomendation_code,
                'recomendation_at' => $this->recomendation_at,
            ]);
            $this->filingService->storeApprovalHeadOfCommitte($filing, $dto);

            $this->handleSuccess();
            $this->notes = null;

        } catch(Exception $e) {
            $this->handleError($e, 'store approval head of committee');
        }
    }

    private function validateHeadOfCommittee(): array
    {
        return $this->validate($this->clinicalPrivilegesRequest->headOfCommitteeRules());
    }

    public function modalClinicalPrivilages(string $id)
    {
        $this->modelId = $id;
        $this->isSubCommittee = true;
        $this->cp_at = Carbon::now();
        $this->letter_no = str_replace('YEAR' ,$this->cp_at->year, Filing::NO_CLINICAL_PRIVILEGES);

        $this->dispatch('open-modal', modalKey: 'clinical-privilages');
    }

    public function createLetterClinicalPrivileges()
    {
        $validateData = $this->validateAndFormatData();

        try {
            $filing = $this->filingService->findOrFail($this->modelId);
            $countExistingFilingUser = $this->filingService->countingCredentialByUser($this->modelId);
            $end_date = Carbon::parse($this->cp_at->format('Y-m-d'))->addYears(Filing::ACTIVE_PERIOD);

            if ($countExistingFilingUser < 2) {
                $validateData['start_date'] = $this->cp_at;
                $validateData['end_date'] = $end_date;
            }

            $validateData['status'] = FilingStatus::DIRECTOR;
            $validateData['cp_created_at'] = Carbon::now();

            $this->filingService->updateStatusWithData($filing, $validateData);

            $this->handleSuccess();
        } catch(Exception $e) {
            $this->handleError($e, 'store clinical privilages');
        }
    }

    private function validateAndFormatData(): array
    {
        return $this->validate([
            'letter_no' => ['required', 'min:20', 'unique:filings,letter_no,'.$this->modelId],
            'cp_at' => ['required']
        ]);
    }

    public function modalUploadFile(string $id): void
    {
        $this->modelId = $id;
        $this->isSubCommittee = true;

        $this->dispatch('open-modal', modalKey: 'form-upload');
    }

    public function storeFileUpload(): void
    {
        $this->validateAndFormatDataUploadFile();

        try {
            $filing = $this->filingService->findOrFail($this->modelId);

            $this->filingService->storeFileUpload($filing, $this->file);

            $this->handleSuccess();

        } catch (Exception $e) {

            $this->handleError($e, 'upload file');
        }
    }

    private function validateAndFormatDataUploadFile(): array
    {
        return $this->validate([
            'file' => ['required', 'mimes:pdf', 'max:2048']
        ]);
    }

    public function modalPrintDoneAll(string $id)
    {
        $this->modelId = $id;
        $this->dispatch('open-modal', modalKey: 'print-done-all');
    }
}
