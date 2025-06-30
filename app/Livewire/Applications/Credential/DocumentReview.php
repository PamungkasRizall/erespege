<?php

namespace App\Livewire\Applications\Credential;

use App\Enums\CategoryType;
use App\Enums\FilingStatus;
use App\Models\Filing;
use App\Services\CategoryService;
use App\Services\FilingService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use App\Traits\{Loggable, NotificationTypes, WithNotification};
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use ZipArchive;

class DocumentReview extends Component
{
    use AuthorizesRequests, NotificationTypes, Loggable, WithNotification;

    public string $meta_title = '';
    public ?string $userId = null;

    public int $numberReqDocument = 0;

    public ?Filing $lastCredential;
    public Collection $categories;
    public Collection $filings;

    private FilingService $filingService;
    private CategoryService $categoryService;

    protected $listeners = [
        'modalApprove',
        'delete',
    ];

    public function boot(
        FilingService $filingService,
        CategoryService $categoryService,
    )
    {
        $this->filingService = $filingService;
        $this->categoryService = $categoryService;
    }

    public function mount()
    {
        $this->authorize('document-reviews');
        $this->initializeData();
    }

    private function initializeData(): void
    {
        $this->loadMetaData();

        $this->categories = $this->categoryService->getCategories(CategoryType::FILING)->sortKeys();
        $this->numberReqDocument = Filing::NUMBER_REQ_DOCUMENT;
    }

    private function loadMetaData(): void
    {
        $this->meta_title = 'Review Dokumen';
    }

    public function render()
    {
        return view('livewire.applications.credential.document-review')
            ->layoutData([
                'title' => $this->meta_title,
                'isSidebarOpen' => 'true',
                'isHeaderBlur' => 'true'
            ]);
    }

    public function modalApprove(string $id)
    {
        $this->userId = $id;

        $this->dispatch('open-modal', modalKey: 'confirm');
    }

    public function approveDocument()
    {
        $this->filings = $this->filingService->getUserFilingsByOrigin($this->userId);

        try {

            foreach($this->filings as $filing)
                $this->filingService->updateStatus($filing, FilingStatus::DONE);

            $this->resetFields();
            $this->handleSuccess();

            return $this->downloadMultipleDocumentAsZip();

        } catch(Exception $e) {
            $this->handleError($e, 'approve document');
        }
    }

    private function resetFields()
    {
        $this->userId = null;
    }

    public function delete(string $id): void
    {
        $this->destroy($id);
    }

    private function destroy(string $filingId)
    {
        try{
            $this->filingService->deleteFiling($filingId);
            $this->handleSuccess();

        } catch (Exception $e) {
            $this->handleError(
                $e,
                'delete',
                null,
                [
                    'error' => $e->getMessage(),
                    'model_id' => $this->model_id ?? null
                ]
            );
        }
    }

    public function downloadMultipleDocumentAsZip()
    {
        try{

            $zipFile = $this->filingService->createMultipleDocumentAsZip($this->filings);

            return response()->download($zipFile)->deleteFileAfterSend(true);

        }catch(Exception $e){
            $this->dispatch('notify', type: 'error',  message: $e->getMessage());
        }
    }
}
