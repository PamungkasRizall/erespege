<?php

namespace App\Livewire\Master;

use App\DTOs\UserDTO;
use App\Http\Requests\UserRequest;
use App\Models\{User};
use App\Traits\{Loggable, NotificationTypes, WithNotification};
use App\Services\{UserService, RoleService, StructureService};
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Exception;
use Illuminate\Support\Collection;

class Users extends Component
{
    use AuthorizesRequests, NotificationTypes, Loggable, WithNotification;

    public const DEFAULT_ROLES = 'Employee';

    public string $meta_title = '';
    public ?string $model_id = null;

    public string $name = '';
    public string $username = '';
    public string $nip = '';
    public ?string $password = '';
    public ?string $password_confirmation = '';
    public array $roles = [];
    public ?int $structureId = null;

    public Collection $roleList;
    public Collection $structures;

    private UserService $userService;
    private RoleService $roleService;
    private StructureService $structureService;

    private UserRequest $userRequest;

    protected $listeners = [
        'edit',
        'delete'
    ];

    public function boot(
        UserService $userService,
        RoleService $roleService,
        StructureService $structureService,
    )
    {
        $this->userService = $userService;
        $this->roleService = $roleService;
        $this->structureService = $structureService;

        $this->userRequest = new UserRequest();
    }

    public function mount()
    {
        $this->authorize('users-list');
        $this->initializeData();
    }

    private function initializeData(): void
    {
        $this->loadMetaData();

        $this->roleList = $this->roleService->all();
        $this->structures = $this->structureService->getStructuresIsMain();

        if (!$this->model_id)
            array_push($this->roles, $this->roleList->search(self::DEFAULT_ROLES));
    }

    private function loadMetaData(): void
    {
        $this->meta_title = 'Users';
    }

    public function render()
    {
        return view('livewire.master.users.users')
            ->layoutData([
                'title' => $this->meta_title,
                'isSidebarOpen' => 'true',
                'isHeaderBlur' => 'true'
            ]);
    }

    public function store()
    {
        $this->authorize('users-create');
        $validateData = $this->validateAndFormatData();

        try {
            $dto = UserDTO::fromObject($validateData);
            $this->userService->storeUser($dto);

            $this->handleSuccess();
            $this->resetFields();

        } catch(Exception $e) {
            $this->handleError($e, 'edit');
        }
    }

    private function validateAndFormatData(): array
    {
        return $this->validate($this->userRequest->rules($this->model_id));
    }

    private function resetFields(bool $closeModal = true):void
    {
        foreach ($this->userRequest::DEFAULT_VALUES as $property => $value) {
            if (property_exists($this, $property)) {
                $this->{$property} = $value;
            }
        }

        if ($closeModal) {
            $this->dispatch('close-modal');
        }
    }

    public function edit(string $id): void
    {
        $this->authorize('users-edit');

        try {
            $user = $this->userService->findOrFail($id);

            $this->fillFormData($user);
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

    private function fillFormData(User $user): void
    {
        $this->model_id = $user->id;
        $this->name = $user->name;
        $this->username = $user->username;
        $this->nip = $user->nip;
        $this->roles = $user->roles->pluck('id')->toArray();
        $this->structureId = $this->userService->mainPosition($user)?->id;
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
        $this->authorize('users-delete');

        $this->model_id = $id;

        $this->dispatch('open-modal', modalKey: 'confirm');
    }

    public function destroy()
    {
        $this->authorize('users-delete');

        try{
            $this->userService->deleteUser($this->model_id);
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
}
