<?php

namespace App\Livewire\Profile;

use App\DTOs\ProfileDTO;
use App\DTOs\UpdateAccountDTO;
use App\Enums\CategoryType;
use App\Enums\Gender;
use App\Http\Requests\ProfileRequest;
use App\Services\{CategoryService, FunctionalPositionService, ProfessionService, ProfileService};
use App\Traits\{Loggable, NotificationTypes, WithNotification};
use Carbon\Carbon;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Profile extends Component
{
    use AuthorizesRequests, NotificationTypes, Loggable, WithNotification;

    public string $meta_title = '';
    public ?int $model_id = null;
    public string $user_id;

    //Profile
    public int $nik;
    public string $place_of_birth = '';
    public Carbon $date_of_birth;
    public ?bool $gender = null;
    public ?string $doctoral_degree = null;
    public string $academic_degree = '';
    public string $address = '';
    public string $province = '';
    public string $city = '';
    public string $subdistrict = '';
    public string $district = '';
    public int $phone;
    public int $phone_emergency;

    public int $profession_id;
    public ?int $functional_position_id;
    public int $employee_status_id;

    //Account
    public string $username;
    public ?string $password = null;
    public ?string $password_confirmation = null;

    public Collection $genders;
    public Collection $professions;
    public Collection $functionalPositions;
    public Collection $employeeStatuses;

    private ProfileService $profileService;
    private CategoryService $categoryService;
    private ProfessionService $professionService;
    private FunctionalPositionService $functionalPositionService;

    private ProfileRequest $profileRequest;

    public function boot(
        ProfileService $profileService,
        CategoryService $categoryService,
        ProfessionService $professionService,
        FunctionalPositionService $functionalPositionService,
    )
    {
        $this->profileService = $profileService;
        $this->categoryService = $categoryService;
        $this->professionService = $professionService;
        $this->functionalPositionService = $functionalPositionService;

        $this->profileRequest = new ProfileRequest();
    }

    public function mount()
    {
        $this->initializeData();
    }

    private function initializeData(): void
    {
        $this->loadMetaData();

        $this->user_id = Auth::id();
        $this->username = Auth::user()->username;

        $this->date_of_birth = Carbon::now()->subYears(17);
        $this->genders = Collect(Gender::values());
        $this->professions = $this->professionService->getProfessions();
        $this->employeeStatuses = $this->categoryService->getCategories(CategoryType::EMPLOYEE_STATUS);

        $this->fillFormData();
    }

    private function loadMetaData(): void
    {
        $this->meta_title = 'Profile';
    }

    public function render()
    {
        return view('livewire.profile.profile')
            ->layoutData([
                'title' => $this->meta_title,
                'isSidebarOpen' => 'false',
                'isHeaderBlur' => 'true'
            ]);
    }

    public function store()
    {
        $validateData = $this->validateAndFormatData();

        try {

            $dto = ProfileDTO::fromObject($validateData);
            $this->profileService->storeProfile($dto);

            $this->handleSuccess();

        } catch(Exception $e) {
            $this->handleError($e);
            $this->logError($e->getMessage(), 'store');
        }
    }

    private function validateAndFormatData(): array
    {
        return $this->validate($this->profileRequest->rules($this->model_id));
    }

    private function handleSuccess(): void
    {
        $this->notifySuccess();

        if (!$this->model_id)
            $this->dispatch('redirect', url: route('profile'));
    }

    private function handleError(Exception $e): void
    {
        $this->notifyError($e->getMessage());
    }

    private function fillFormData(): void
    {
        $profile = Auth::user()->profile;

        if ($profile)
        {
            $this->model_id = $profile->id;
            $this->nik = $profile->nik;
            $this->place_of_birth = $profile->place_of_birth;
            $this->date_of_birth = $profile->date_of_birth;
            $this->gender = $profile->gender;
            $this->doctoral_degree = $profile->doctoral_degree;
            $this->academic_degree = $profile->academic_degree;
            $this->address = $profile->address;
            $this->province = $profile->province;
            $this->city = $profile->city;
            $this->subdistrict = $profile->subdistrict;
            $this->district = $profile->district;
            $this->phone = $profile->phone;
            $this->phone_emergency = $profile->phone_emergency;
            $this->profession_id = $profile->profession_id;
            $this->updatedProfessionId($this->profession_id);
            $this->functional_position_id = $profile->functional_position_id;
            $this->employee_status_id = $profile->employee_status_id;
        }
    }

    public function storeAccount()
    {
        $validateData = $this->validateAndFormatDataAccount();

        try {

            $dto = UpdateAccountDTO::fromObject($validateData);
            $this->profileService->storeAccount($dto);

            $this->handleSuccess();

        } catch(Exception $e) {
            $this->handleError($e);
            $this->logError($e->getMessage(), 'store');
        }
    }

    private function validateAndFormatDataAccount(): array
    {
        return $this->validate($this->profileRequest->accountRules($this->user_id));
    }

    public function updatedProfessionId($value)
    {
        $this->functionalPositions = $this->functionalPositionService->getFunctionalPositions($value);
        $this->functional_position_id = null;
    }
}
