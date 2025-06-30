<?php

namespace App\Livewire\Applications;

use App\DTOs\FilingDTO;
use App\Enums\CategoryType;
use App\Enums\FilingStatus;
use App\Http\Requests\FilingRequest;
use App\Models\Filing as ModelsFiling;
use Livewire\Component;
use App\Services\{FilingService, CategoryService};
use App\Traits\{Loggable, NotificationTypes, WithNotification};
use Carbon\Carbon;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

class Filing extends Component
{
    use AuthorizesRequests, WithFileUploads, NotificationTypes, Loggable, WithNotification;

    public string $meta_title = '';
    public ?string $model_id = null;

    public string $name = '';
    public int $category_id;
    public string $letter_no;
    public Carbon $start_date;
    public ?Carbon $end_date = null;
    public bool $is_end = false;
    public ?UploadedFile $file = null;

    public bool $reCredential = false;
    public int $numberReqDocument = 0;
    public Collection $categories;
    public Collection $filings;

    private FilingService $filingService;
    private CategoryService $categoryService;

    private FilingRequest $filingRequest;

    protected $listeners = [
        'edit',
        'delete',
        'modalFormUpload',
    ];

    public function boot(
        FilingService $filingService,
        CategoryService $categoryService,
    )
    {
        $this->filingService = $filingService;
        $this->categoryService = $categoryService;

        $this->filingRequest = new FilingRequest();
    }

    public function mount()
    {
        $this->initializeData();
    }

    private function initializeData(): void
    {
        $this->loadMetaData();

        $this->start_date = Carbon::now();
        $this->reCredential = boolval($this->filingService->countingCredentialByUser(Auth::id(), FilingStatus::DONE));
        $this->numberReqDocument = ModelsFiling::NUMBER_REQ_DOCUMENT;

        $this->setFilings();
        $this->setCategories();
    }

    private function loadMetaData(): void
    {
        $this->meta_title = 'Pemberkasan';
    }

    public function render()
    {
        return view('livewire.applications.filing.index');
    }

    public function store()
    {
        $validateData = $this->validateAndFormatData();

        try {

            $dto = FilingDTO::fromObject($validateData);

            $this->filingService->checkLastCredential($dto);

            $this->filingService->storeFiling($dto, $this->file);

            $this->resetFields();
            $this->handleSuccess();

            $this->setFilings();
            $this->setCategories();

        } catch(Exception $e) {
            $this->handleError($e, 'store');
        }
    }

    private function validateAndFormatData(): array
    {
        return $this->validate($this->filingRequest->rules($this->model_id));
    }

    private function resetFields(bool $closeModal = true):void
    {
        foreach ($this->filingRequest::DEFAULT_VALUES as $property => $value) {
            if (property_exists($this, $property)) {
                $this->{$property} = $value;
            }
        }

        if ($closeModal) {
            $this->dispatch('close-modal');
        }
    }

    private function hisData(string $user_id): bool
    {
        return Auth::id() == $user_id;
    }

    public function delete(string $id): void
    {
        $this->model_id = $id;

        $this->dispatch('open-modal', modalKey: 'confirm');
    }

    public function destroy()
    {
        try{
            $this->filingService->deleteFiling($this->model_id);
            $this->handleSuccess();

            $this->setFilings();
            $this->setCategories();
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

    private function setFilings()
    {
        $this->filings = $this->filingService->getUserFilingsByOrigin(Auth::id());

        if(!$this->reCredential)
            $this->reCredential = $this->filings->contains('name', ModelsFiling::KREDENSIAL);
    }

    private function setCategories()
    {
        $this->categories = $this->categoryService->getCategories(CategoryType::FILING)->sortKeys();
    }

    public function modalFormUpload(int $id): void
    {
        $this->category_id = $id;
        $this->name = $this->categories->get($id);

        $this->dispatch('open-modal');
    }
}
