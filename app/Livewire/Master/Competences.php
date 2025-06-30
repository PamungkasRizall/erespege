<?php

namespace App\Livewire\Master;

use App\DTOs\CompetenceDTO;
use App\Http\Requests\CompetenceRequest;
use App\Models\Choice;
use App\Services\CompetenceService;
use App\Services\FunctionalPositionService;
use App\Services\ProfessionService;
use App\Traits\{Loggable, NotificationTypes, WithNotification};
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithFileUploads;

class Competences extends Component
{
    use AuthorizesRequests, NotificationTypes, Loggable, WithNotification, WithFileUploads;

    public string $meta_title = '';
    public ?string $model_id = null;

    public string $code = '';
    public ?int $profession_id = null;
    public ?int $functional_position_id = null;
    public ?UploadedFile $file = null;
    public array $choices = [];

    public Collection $professions;
    public Collection $functionalPositions;

    private CompetenceService $competenceService;
    private ProfessionService $professionService;
    private FunctionalPositionService $functionalPositionService;

    private CompetenceRequest $competenceRequest;

    protected $listeners = [
        'activation'
    ];

    public function boot(
        CompetenceService $competenceService,
        ProfessionService $professionService,
        FunctionalPositionService $functionalPositionService,
    )
    {
        $this->competenceService = $competenceService;
        $this->professionService = $professionService;
        $this->functionalPositionService = $functionalPositionService;
        $this->competenceRequest = new CompetenceRequest();
    }

    public function mount()
    {
        $this->authorize('competences-list');
        $this->initializeData();
    }

    private function initializeData(): void
    {
        $this->loadMetaData();

        // $competence = Competence::with('choices')->first();
        // dd($competence->details->flatten()->toArray());

        $this->professions = $this->professionService->getProfessions();
        $this->setChoices();
    }

    private function setChoices()
    {
        $this->choices = Choice::DEFAULT_CHOICES;
    }

    private function loadMetaData(): void
    {
        $this->meta_title = 'Daftar Kompetensi';
    }

    public function render()
    {
        return view('livewire.master.competences.index')
            ->layoutData([
                'title' => $this->meta_title,
                'isSidebarOpen' => 'true',
                'isHeaderBlur' => 'true'
            ]);
    }

    public function store()
    {
        $this->authorize('competences-create');
        $validateData = $this->validateAndFormatData();

        try {

            $dto = CompetenceDTO::fromObject($validateData);
            $this->competenceService->storeCompetence($dto);

            $this->resetFields();
            $this->handleSuccess();

        } catch(Exception $e) {
            $this->handleError($e, 'store');
        }
    }

    private function validateAndFormatData(): array
    {
        return $this->validate($this->competenceRequest->rules($this->model_id));
    }

    private function resetFields():void
    {
        foreach ($this->competenceRequest::DEFAULT_VALUES as $property => $value) {
            if (property_exists($this, $property)) {
                $this->{$property} = $value;
            }
        }
    }

    public function updatedProfessionId($value): void
    {
        $this->functionalPositions = $this->functionalPositionService->getFunctionalPositions($value);
        $this->functional_position_id = null;
    }

    public function activation(string $id): void
    {
        $this->model_id = $id;

        $this->dispatch('open-modal', modalKey: 'confirm');
    }

    public function storeActivation()
    {
        try {

            $this->competenceService->storeActivation($this->model_id);

            $this->handleSuccess();

        } catch(Exception $e) {
            $this->handleError($e, 'activation');
        }
    }

    public function download()
    {
        return response()->download(public_path('excel-templates/template-kredensial-skk.xlsx'));
    }
}
