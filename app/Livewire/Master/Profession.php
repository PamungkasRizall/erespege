<?php

namespace App\Livewire\Master;

use App\DTOs\ProfessionDTO;
use App\Enums\Committee;
use App\Http\Requests\ProfessionRequest;
use App\Models\Profession as ModelsProfession;
use App\Traits\{Loggable, NotificationTypes, WithNotification};
use App\Services\ProfessionService;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Collection;
use Livewire\Component;

class Profession extends Component
{
    use AuthorizesRequests, NotificationTypes, Loggable, WithNotification;

    public string $meta_title = '';
    public ?string $model_id = null;

    public string $name = '';
    public ?Committee $committee = null;
    public array $assesors;
    public Collection $assesorsx;

    public Collection $committees;
    public ModelsProfession $profession;

    private ProfessionService $professionService;

    private ProfessionRequest $professionRequest;

    protected $listeners = [
        'edit',
        'delete'
    ];

    public function boot(ProfessionService $professionService): void
    {
        $this->professionService = $professionService;

        $this->professionRequest = new ProfessionRequest();
    }

    public function mount()
    {
        $this->authorize('professions-list');
        $this->initializeData();
    }

    private function initializeData(): void
    {
        $this->loadMetaData();
        $this->assesorsx = collect([
            ['id' => 123, 'title' => 'Item 1'],
            ['id' => 456, 'title' => 'Item 2'],
            ['id' => 789, 'title' => 'Item 3'],
        ]);
        $this->committees = collect(Committee::values());
        $this->committee = authUserCommittee();
    }

    private function loadMetaData(): void
    {
        $this->meta_title = 'Profesi';
    }

    public function render()
    {
        return view('livewire.master.professions.index')
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

            $dto = ProfessionDTO::fromObject($validateData);
            $this->professionService->storeProfession($dto);

            $this->handleSuccess();
            $this->resetFields();
        } catch(Exception $e) {
            $this->handleError($e, 'store');
        }
    }

    private function validateAndFormatData(): array
    {
        return $this->validate($this->professionRequest->rules($this->model_id));
    }

    private function resetFields(bool $closeModal = true):void
    {
        foreach ($this->professionRequest::DEFAULT_VALUES as $property => $value) {
            if (property_exists($this, $property)) {
                $this->{$property} = $value;
            }
        }
    }

    public function edit(string $id): void
    {
        try {
            $this->profession = $this->professionService->findOrFail($id);

            $this->fillFormData($this->profession);
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

    private function fillFormData(ModelsProfession $profession): void
    {
        $this->model_id = $profession->id;
        $this->name = $profession->name;
        $this->committee = $profession->committee;
        $this->assesors = $profession->assesors->pluck('id')->toArray();
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
            $this->professionService->deleteProfession($this->model_id);
            $this->handleSuccess();

        } catch (Exception $e) {
            $this->handleError($e, 'delete');
        }
    }
}
