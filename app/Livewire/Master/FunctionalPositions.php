<?php

namespace App\Livewire\Master;

use App\DTOs\FunctionalPositionDTO;
use App\Http\Requests\FunctionalPositionRequest;
use App\Models\FunctionalPosition;
use App\Traits\{Loggable, NotificationTypes};
use App\Services\FunctionalPositionService;
use App\Services\ProfessionService;
use App\Traits\WithNotification;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Collection;
use Livewire\Component;

class FunctionalPositions extends Component
{
    use AuthorizesRequests, NotificationTypes, Loggable, WithNotification;

    public string $meta_title = '';

    public string $name = '';
    public int $profession_id;

    public ?string $model_id = null;

    public Collection $professions;

    private FunctionalPositionService $functionalPositionService;
    private ProfessionService $professionService;
    private FunctionalPositionRequest $functionalPositionRequest;

    protected $listeners = [
        'edit',
        'delete'
    ];

    public function boot(FunctionalPositionService $functionalPositionService, ProfessionService $professionService): void
    {
        $this->functionalPositionService = $functionalPositionService;
        $this->professionService = $professionService;
        $this->functionalPositionRequest = new FunctionalPositionRequest();
    }

    public function mount()
    {
        $this->authorize('functional-positions-list');
        $this->initializeData();
    }

    private function initializeData(): void
    {
        $this->loadMetaData();
        $this->professions = $this->professionService->getProfessions();
    }

    private function loadMetaData(): void
    {
        $this->meta_title = 'Kompetensi Profesi';
    }

    public function render()
    {
        return view('livewire.master.functional-positions.index')
            ->layoutData([
                'title' => $this->meta_title,
                'isSidebarOpen' => 'true',
                'isHeaderBlur' => 'true'
            ]);
    }

    public function store()
    {
        $validateData = $this->validateAndFormatData();

        try {

            $dto = FunctionalPositionDTO::fromObject($validateData);
            $this->functionalPositionService->storeFunctionalPosition($dto);

            $this->resetFields();
            $this->handleSuccess();

        } catch(Exception $e) {
            $this->handleError($e, 'store');
        }
    }

    private function validateAndFormatData(): array
    {
        return $this->validate($this->functionalPositionRequest->rules($this->model_id));
    }

    private function resetFields(bool $closeModal = true):void
    {
        foreach ($this->functionalPositionRequest::DEFAULT_VALUES as $property => $value) {
            if (property_exists($this, $property)) {
                $this->{$property} = $value;
            }
        }

        if ($closeModal) {
            $this->dispatch('close-modal');
        }
    }

    public function edit(string$id): void
    {
        try {
            $functionalPosition = $this->functionalPositionService->findOrFail($id);

            $this->fillFormData($functionalPosition);
            $this->openEditModal();
        } catch (Exception $e) {
            $this->handleError(
                $e,
                'edit',
                "Failed to load {$this->meta_title} data",
                [
                    'error' => $e->getMessage(),
                    'model_id' => $this->model_id ?? null
                ]
            );
        }
    }

    private function fillFormData(FunctionalPosition $functionalPosition): void
    {
        $this->model_id = $functionalPosition->id;
        $this->name = $functionalPosition->name;
        $this->profession_id = $functionalPosition->profession_id;
    }

    private function openEditModal(): void
    {
        $this->dispatch('open-modal', [
            'title' => "Edit {$this->meta_title}",
            'mode' => 'edit'
        ]);
    }

    public function delete(string $id): void
    {
        $this->model_id = $id;

        $this->dispatch('open-modal', modalKey: 'confirm');
    }

    public function destroy()
    {
        try{
            $this->functionalPositionService->deleteFunctionalPosition($this->model_id);
            $this->handleSuccess();
        } catch (Exception $e) {
            $this->handleError($e);
            $this->logError('FunctionalPosition', 'deletion', [
                'error'=> $e->getMessage(),
                'model_id' => $this->model_id
            ]);
        }
    }
}
