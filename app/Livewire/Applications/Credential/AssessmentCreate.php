<?php

namespace App\Livewire\Applications\Credential;

use App\DTOs\CompetenceAnswerDTO;
use App\DTOs\CompetenceAssesorAnswerDTO;
use App\DTOs\FilingDTO;
use App\Enums\CategoryType;
use App\Enums\FilingOrigin;
use App\Enums\FilingStatus;
use App\Models\Competence;
use App\Models\Filing;
use App\Models\User;
use App\Services\CategoryService;
use App\Services\CompetenceAnswerService;
use App\Services\CompetenceService;
use App\Services\FilingService;
use Livewire\Component;
use App\Traits\{Loggable, NotificationTypes, WithNotification};
use Carbon\Carbon;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AssessmentCreate extends Component
{
    use AuthorizesRequests, NotificationTypes, Loggable, WithNotification;

    private const TEST_MINUTES = 120;

    public string $meta_title = '';
    public ?string $model_id = null;

    public array $answers = [];
    public int $countDown = 0;
    public int $numberOfDetails = 0;
    public bool $isAssesor = false;

    //Review
    public array $assesor_answers = [];
    public array $notes_assessor_answers = [];

    public ?Filing $lastCredential;
    public ?Filing $filing;
    public ?Competence $competence = null;
    public ?User $user;
    public bool $assessmentOnPeriod = false;

    private Collection $existingDocuments;

    private FilingService $filingService;
    private CompetenceService $competenceService;
    private CompetenceAnswerService $competenceAnswerService;
    private CategoryService $categoryService;

    protected $listeners = [
        'setAnswer',
        'confirmModal',
        'setAnswerAssessor',
        'loadAssesorAnswerFromDataTable',
    ];

    public function boot(
        FilingService $filingService,
        CompetenceService $competenceService,
        CompetenceAnswerService $competenceAnswerService,
        CategoryService $categoryService,
    )
    {
        $this->filingService = $filingService;
        $this->competenceService = $competenceService;
        $this->competenceAnswerService = $competenceAnswerService;
        $this->categoryService = $categoryService;
    }

    public function mount($id = null)
    {
        $this->model_id = $id;
        if ($this->model_id)
            $this->isAssesor = true;

        $authorize = $this->isAssesor ? 'assessor-create' : 'credential-assessment';
        $this->authorize($authorize);
        $this->initializeData();
    }

    private function initializeData(): void
    {
        $this->loadMetaData();

        if ($this->isAssesor)
            $this->handleAssessor();

        $this->setCompetence();

        if (!$this->isAssesor)
            $this->checkCompleteDocuments();
    }

    private function loadMetaData(): void
    {
        $this->meta_title = 'Assesmen Kredensial';
    }

    public function render()
    {
        return view('livewire.applications.credential.assessment-create')
            ->layoutData([
                'title' => $this->meta_title,
                'isSidebarOpen' => 'true',
                'isHeaderBlur' => 'true'
            ]);
    }

    private function checkCompleteDocuments()
    {
        $this->existingDocuments = $this->filingService->getUserFilingsByOrigin(Auth::id());
        $isDocumentReview = $this->existingDocuments->contains('status', FilingStatus::SUB_COMMITTEE);

        if ($isDocumentReview) {
            $this->redirectToIndex('Dokumen Sedang Direview Oleh Sub Komite, Mohon Menunggu / Silahkan Lengkapi Semua Dokumen');
        }

        $this->checkLastCredential();
    }

    private function checkLastCredential()
    {
        $this->lastCredential = $this->filingService->getLastCredential();

        if ($this->lastCredential) {
            $this->user = $this->lastCredential->user;

            $this->checkAssessmentOnPeriod();

        } else {
            $this->user = Auth::user();
            $this->storeFilingCredential();
        }
    }

    private function handleAssessor()
    {
        $this->filing = $this->filingService->findOrFail($this->model_id, ['user', 'competence.details', 'competence.choices', 'answers']);

        if ($this->filing->status !== FilingStatus::REVIEW)
        {
            return redirect()->route('applications.credential.assessor-reviews.index');
        }

        $this->user = $this->filing->user;
        $this->loadAnswer();
    }

    private function checkAssessmentOnPeriod()
    {
        if ($this->lastCredential->status === FilingStatus::DONE) { //done
            $this->assessmentOnPeriod = $this->filingService->assessmentOnPeriod($this->lastCredential);

            if (!$this->assessmentOnPeriod) {
                $this->redirectToIndex('Saat ini Anda Tidak Dalam Masa Assesmen');
            }
        }

        $this->checkAssessmentOnReview();
    }

    private function checkAssessmentOnReview()
    {
        if ($this->lastCredential->status === FilingStatus::REVIEW)
        {
            $this->redirectToIndex('Assesmen Kredensial Dalam Tahap Review oleh Assesor');
        }

        $this->checkAssessmentOnPending();
    }

    private function checkAssessmentOnPending()
    {
        if ($this->lastCredential->status === FilingStatus::PENDING)
        {
            $this->filing = $this->lastCredential;

            $this->handleCountDown();
            $this->loadAnswer();
        } else {
            $documentsApproved = $this->existingDocuments->where('status', FilingStatus::DONE)->count();

            if ($documentsApproved !== Filing::NUMBER_REQ_DOCUMENT) {
                $this->redirectToIndex('Dokumen Sedang Direview Oleh Sub Komite, Mohon Menunggu / Silahkan Lengkapi Semua Dokumen');
            } else {
                $this->storeFilingCredential($this->lastCredential);
            }
        }
    }

    private function setCompetence()
    {
        $this->competence = $this->isAssesor
            ? $this->filing->competence
            : $this->competenceService->findByFunctionalPosition();

        if (!$this->competence) {
            abort(404, 'Belum Ada Assesmen Kredensial Yang Aktif, Hubungi Komite');
            // return redirect()->route('applications.credential.assessments.index')
            //     ->with('message', 'Belum Ada Assesmen Kredensial Yang Aktif, Hubungi Komite');
        }

        $this->numberOfDetails = $this->competenceService->numberOfDetails($this->competence->details);
    }

    private function storeFilingCredential(?Filing $filing = null)
    {
        $documentsApproved = $this->existingDocuments->where('status', FilingStatus::DONE)->count();

        if ($documentsApproved < 2) {

            $this->redirectToIndex('Silahkan Lengkapi Semua Dokumen');
        }

        $validateData = [
            'name' => Filing::KREDENSIAL,
            'category_id' => $this->categoryService->getCategoryIdByName(CategoryType::KREDENSIAL, Filing::KREDENSIAL),
            'letter_no' => 'BELUM-ADA/'.time(),
            'start_date' => $filing?->end_date->addDay() ?? Carbon::now(),
            'end_date' => $filing?->end_date->addDay()->addYears(Filing::ACTIVE_PERIOD) ?? Carbon::now()->addYears(Filing::ACTIVE_PERIOD),
            'status' => FilingStatus::PENDING,
            'origin' => FilingOrigin::SYSTEM,
            'competence_id' => $this->competence->id,
            'str_code' => $this->existingDocuments->first(fn ($filing) => Str::contains($filing->name, 'Surat Tanda Register'))->letter_no,
            'sik_code' => $this->existingDocuments->first(fn ($filing) => Str::contains($filing->name, 'SIK'))->letter_no
        ];

        try {

            $dto = FilingDTO::fromObject($validateData);
            $this->filing = $this->filingService->storeFiling($dto);

        } catch(Exception $e) {
            $this->handleError($e, 'store');

            $this->redirectToIndex('Tidak Bisa Menentukan Data Awal, Hubungi Panitia');
        }
    }

    private function handleCountDown()
    {
        $time = $this->filing->created_at;
        $this->countDown = $time->addMinute(self::TEST_MINUTES)->timestamp * 1000;

        if(($this->countDown - (Carbon::now()->timestamp * 1000)) < 1)
            $this->endTest();
    }

    public function setAnswer(string $value, int $detail, int $serial_number)
    {
        $competenceDetailId = $detail;
        // $this->answers[$serial_number] = $value;

        $this->storeAnswer($value, $competenceDetailId);
    }

    private function storeAnswer(string $value, int $competenceDetailId)
    {
        $choiceSerialNumber = ord($value) - ord('A') + 1;
        $choiceId = $this->competence->choices->where('sequence', $choiceSerialNumber)->first()->id;

        $validateData = [
            'competence_detail_id' => $competenceDetailId,
            'user_id' => Auth::id(),
            'filing_id' => $this->filing->id,
            'choice_id' => $choiceId,
        ];

        try {

            $dto = CompetenceAnswerDTO::fromObject($validateData);
            $this->competenceAnswerService->storeAnswer($dto);

        } catch(Exception $e) {
            $this->handleError($e, 'set answer');
        }
    }

    public function setAnswerAssessor(string $value, int $detail, int $serial_number)
    {
        $competenceDetailId = $detail;
        // $this->assesor_answers[$serial_number] = $value;

        $this->storeAnswerAssessor($value, $competenceDetailId);
    }

    private function storeAnswerAssessor(string $value, int $competenceDetailId)
    {
        $choiceSerialNumber = ord($value) - ord('A') + 1;
        $choiceId = $this->competence->choices->where('sequence', $choiceSerialNumber)->first()->id;

        $validateData = [
            'competence_detail_id' => $competenceDetailId,
            'filing_id' => $this->filing->id,
            'assesor_id' => Auth::id(),
            'ass_choice_id' => $choiceId,
        ];

        try {

            $dto = CompetenceAssesorAnswerDTO::fromObject($validateData);
            $this->competenceAnswerService->storeAnswer($dto);

        } catch(Exception $e) {
            $this->handleError($e, 'set answer');
        }
    }

    public function updatedNotesAssessorAnswers($value, $key)
    {
        $this->storedNotesAssessorAnswers($value, $key);
    }

    public function storedNotesAssessorAnswers($value, $competenceDetailId)
    {
        $validateData = [
            'competence_detail_id' => $competenceDetailId,
            'filing_id' => $this->filing->id,
            'ass_notes' => $value,
        ];

        try {

            $dto = (object) $validateData;
            $this->competenceAnswerService->storeAnswer($dto);

        } catch(Exception $e) {
            $this->handleError($e, 'set answer');
        }
    }

    private function loadAnswer()
    {
        $answers = $this->competenceAnswerService->getAnswersByFiling($this->filing);
        $this->answers = $answers;

        if ($this->isAssesor)
        {
            $assesor_answers = $this->competenceAnswerService->getAnswersByFiling($this->filing, true);
            $this->assesor_answers = $assesor_answers;

            $notes_assessor_answers = $this->competenceAnswerService->getAnswersByFiling($this->filing, true, true);
            $this->notes_assessor_answers = $notes_assessor_answers;
        }
    }

    public function confirmModal()
    {
        $this->dispatch('open-modal', modalKey: 'confirm');
    }

    public function endTest(bool $timeOut = false)
    {
        $count = $this->isAssesor
            ? countNotNull($this->assesor_answers)
            : countNotNull($this->answers);
        $remainingTest = $this->numberOfDetails - $count;

        if ($remainingTest > 0)
        {
            $this->notifyError('Selesaikan Semuanya Terlebih Dahulu.');
            $this->dispatch('close-modal');

            return false;
        }

        try {

            $status = $this->isAssesor ? FilingStatus::BA : FilingStatus::REVIEW;

            $this->filingService->updateStatus($this->filing, $status);

            $this->notifySuccess();

            $route = $this->isAssesor ? 'applications.credential.assessor-reviews.index' : 'applications.credential.assessments.index';
            return redirect()->route($route);

        } catch(Exception $e) {
            $this->handleError($e, 'end test');
        }
    }

    private function redirectToIndex(string $message)
    {
        session()->flash('message', $message);
        return redirect()->route('applications.credential.assessments.index');
    }
}
