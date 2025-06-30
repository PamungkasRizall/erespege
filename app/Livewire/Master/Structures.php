<?php

namespace App\Livewire\Master;

use App\DTOs\StructureDTO;
use App\Http\Requests\StructureRequest;
use App\Models\Structure;
use App\Services\DepartmentService;
use App\Services\StructureService;
use App\Traits\{Loggable, NotificationTypes, WithNotification};
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Collection;
use Livewire\Component;

class Structures extends Component
{
    use AuthorizesRequests, NotificationTypes, Loggable, WithNotification;

    public string $meta_title = '';
    public ?string $modelId = null;

    public string $name = '';
    public bool $isUnique = false;
    public bool $isMain = true;
    public int $parentId;
    public int $departmentId;

    public Collection $uniques;
    public Collection $primaries;
    public Collection $headOfs;
    public Collection $departments;
    public Structure $structure;

    private StructureService $structureService;
    private DepartmentService $departmentService;

    private StructureRequest $structureRequest;

    protected $listeners = [
        'edit',
        'delete',
        'addUser'
    ];

    public function boot(
        StructureService $structureService,
        DepartmentService $departmentService
    ): void
    {
        $this->structureService = $structureService;
        $this->departmentService = $departmentService;

        $this->structureRequest = new StructureRequest();
    }

    public function mount()
    {
        $this->authorize('structure-list');
        $this->initializeData();
    }

    private function initializeData(): void
    {
        $this->loadMetaData();

        $this->uniques = collect(['Tidak', 'Ya']);
        $this->primaries = collect(['Tidak', 'Ya']);
        $this->headOfs = $this->structureService->getAllHeadOfs();
        $this->departments = $this->departmentService->getAllDepartments(true);
    }

    private function loadMetaData(): void
    {
        $this->meta_title = 'Struktur Organisasi';
    }

    public function render()
    {
        return view('livewire.master.structures.index')
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

            $dto = StructureDTO::fromObject($validateData);
            $this->structureService->storeStructure($dto);

            $this->handleSuccess();
            $this->resetFields();
        } catch(Exception $e) {
            $this->handleError($e, 'store');
        }
    }

    private function validateAndFormatData(): array
    {
        return $this->validate($this->structureRequest->rules($this->modelId));
    }

    private function resetFields():void
    {
        foreach ($this->structureRequest::DEFAULT_VALUES as $property => $value) {
            if (property_exists($this, $property)) {
                $this->{$property} = $value;
            }
        }
    }

    public function edit(int $id): void
    {
        try {
            $this->structure = $this->structureService->getStructureById($id);

            $this->fillFormData($this->structure);
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

    private function fillFormData(Structure $structure): void
    {
        $this->modelId = $structure->id;
        $this->name = $structure->name;
        $this->isUnique = $structure->is_unique;
        $this->parentId = $structure->parent_id;
    }

    private function openEditModal(): void
    {
        $this->dispatch('open-modal', [
            'title' => "Edit {$this->meta_title}",
            'mode' => 'edit'
        ]);
    }

    public function delete(int $id): void
    {
        $this->modelId = $id;

        $this->dispatch('open-modal', modalKey: 'confirm');
    }

    public function destroy()
    {
        try{
            $this->structureService->deleteStructure($this->modelId);
            $this->handleSuccess();

        } catch (Exception $e) {
            $this->handleError($e, 'delete');
        }
    }

    //JABATAN
    public function addUser(int $id): void
    {
        $this->modelId = $id;

        $this->dispatch('open-modal', modalKey: 'add-user');
    }
}
