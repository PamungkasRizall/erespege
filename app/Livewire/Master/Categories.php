<?php

namespace App\Livewire\Master;

use App\DTOs\CategoryDTO;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Traits\{Loggable, NotificationTypes};
use App\Services\CategoryService;
use App\Traits\WithNotification;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Collection;
use Livewire\Component;

class Categories extends Component
{
    use AuthorizesRequests, NotificationTypes, Loggable, WithNotification;

    public string $meta_title = '';
    public ?string $model_id = null;

    public string $name = '';
    public string $type = '';
    public array $assesors;

    public Category $category;

    public Collection $typeList;

    private CategoryService $categoryService;
    private CategoryRequest $categoryRequest;

    protected $listeners = [
        'edit',
        'delete'
    ];

    public function boot(CategoryService $categoryService): void
    {
        $this->categoryService = $categoryService;
        $this->categoryRequest = new CategoryRequest();
    }

    public function mount()
    {
        $this->authorize('categories');
        $this->initializeData();
    }

    private function initializeData(): void
    {
        $this->loadMetaData();
        $this->typeList = $this->categoryService->getTypes();
    }

    private function loadMetaData(): void
    {
        $this->meta_title = 'Kategori';
    }

    public function render()
    {
        return view('livewire.master.categories')
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

            $dto = CategoryDTO::fromObject($validateData);
            $this->categoryService->storeCategory($dto);

            $this->resetFields();
            $this->handleSuccess();

        } catch(Exception $e) {
            $this->handleError($e, 'store');
        }
    }

    private function validateAndFormatData(): array
    {
        return $this->validate($this->categoryRequest->rules($this->model_id));
    }

    private function resetFields(bool $closeModal = true):void
    {
        foreach ($this->categoryRequest::DEFAULT_VALUES as $property => $value) {
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
            $this->category = $this->categoryService->findOrFail($id);

            $this->fillFormData($this->category);
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

    private function fillFormData(Category $category): void
    {
        $this->model_id = $category->id;
        $this->name = $category->name;
        $this->type = $category->type;
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
            $this->categoryService->deleteCategory($this->model_id);
            $this->handleSuccess();
        } catch (Exception $e) {
            $this->handleError($e, 'deletion');
        }
    }
}
