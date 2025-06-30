<?php

namespace App\Livewire\Applications\Credential;

use App\DTOs\CompetenceBADTO;
use App\Http\Requests\CompetenceBARequest;
use App\Services\CompetenceBAService;
use App\Traits\{Loggable, NotificationTypes, WithNotification};
use Carbon\Carbon;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class AssesorReviews extends Component
{
    use AuthorizesRequests, NotificationTypes, Loggable, WithNotification;

    public string $meta_title = '';
    public ?string $model_id = null;

    //BA
    public Carbon $date_at;
    public string $location;
    public array $filings;

    private CompetenceBAService $competenceBAService;

    private CompetenceBARequest $competenceBARequest;

    public function boot(CompetenceBAService $competenceBAService): void
    {
        $this->competenceBAService = $competenceBAService;

        $this->competenceBARequest = new CompetenceBARequest();
    }

    public function mount()
    {
        $this->authorize('assessor-list');
        $this->initializeData();
    }

    private function initializeData(): void
    {
        $this->loadMetaData();

        $this->date_at = Carbon::now();
    }

    private function loadMetaData(): void
    {
        $this->meta_title = 'Assesor Review';
    }

    public function render()
    {
        return view('livewire.applications.credential.assesor-reviews.assesor-reviews')
            ->layoutData([
                'title' => $this->meta_title,
                'isSidebarOpen' => 'true',
                'isHeaderBlur' => 'true'
            ]);
    }

    //BA
    public function store()
    {
        $validateData = $this->validateAndFormatData();

        try {

            $dto = CompetenceBADTO::fromObject($validateData);
            $this->competenceBAService->storeBA($dto);

            $this->handleSuccess();
            $this->resetFields();
        } catch(Exception $e) {
            $this->handleError($e, 'store');
        }
    }

    private function validateAndFormatData(): array
    {
        return $this->validate($this->competenceBARequest->rules());
    }

    private function resetFields(bool $closeModal = true):void
    {
        foreach ($this->competenceBARequest::DEFAULT_VALUES as $property => $value) {
            if (property_exists($this, $property)) {
                $this->{$property} = $value;
            }
        }

        if ($closeModal) {
            $this->dispatch('close-modal');
        }
    }
}
