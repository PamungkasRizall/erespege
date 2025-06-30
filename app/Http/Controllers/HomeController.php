<?php

namespace App\Http\Controllers;

use App\Enums\FilingStatus;
use App\Models\Filing;
use App\Models\User;
use App\Services\CompetenceBAService;
use App\Services\FilingService;
use App\Services\StructureService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class HomeController extends Controller
{
    public $f4 = [0.0, 0.0, 595.4, 935.5];
    protected StructureService $structureService;
    protected CompetenceBAService $competenceBAService;
    protected FilingService $filingService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        StructureService $structureService,
        CompetenceBAService $competenceBAService,
        FilingService $filingService
    )
    {
        $this->middleware('auth');

        setlocale(LC_ALL, 'IND');

        $this->structureService = $structureService;
        $this->competenceBAService = $competenceBAService;
        $this->filingService = $filingService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    //AUTOCOMPLETE SEARCH
    public function search(string $category)
    {
        if(request()->ajax())
        {
            return match ($category) {
                'user' => $this->searchUser(),
                'filing-user' => $this->searchFilingUser(),
                default => [],
            };
        }

        return abort(404);
    }

    private function searchUser()
    {
        return User::select('id', DB::raw('TRIM(UPPER(name)) as title'))
                ->where('name', 'like', '%' . request('q') . '%')
                ->where('profile_completed', true)
                ->limit(5)
                ->get();
    }

    private function searchFilingUser()
    {
        return Filing::select(['id', 'user_id'])
                ->with(['assessor', 'user'])
                ->where('status', FilingStatus::BA)
                ->whereHas('assessor', fn($q) => $q->where('assesor_id', Auth::id()))
                ->whereHas('user', fn($q) => $q->where('name', 'like', '%a%'))
                ->limit(5)
                ->get()
                ->map(fn($item) => [
                    'id' => $item->id,
                    'title' => $item->user->name,
                ]);
    }

    //PRINT PDF
    public function printBeritaAcara(string $id)
    {
        $beritaAcara = $this->competenceBAService->getBAByFilingId($id);
        if (!$beritaAcara)
        {
            abort(404);
        }

        $filings = $this->filingService->getAllByIds($beritaAcara->filings);

        $pdf = Pdf::loadView('livewire.applications.credential.prints.berita-acara', [
                        'beritaAcara' => $beritaAcara,
                        'filings' => $filings,
                    ])
                    // ->setPaper($this->f4)
                    ->setWarnings(false);

        return $pdf->stream("Berita-Acara-".time().".pdf");
    }

    public function printRekomendasiPenerbitanPenugasaKlinis(string $id)
    {
        $beritaAcara = $this->competenceBAService->getBAByFilingId($id);
        if (!$beritaAcara)
        {
            abort(404);
        }

        $filing = $this->filingService->findOrFail($id, ['competence.choices', 'answers']);
        if (!$filing)
        {
            abort(404);
        }

        if ($filing->approvals()->exists())
        {
            $headOfCommittee = $filing->approvals->first();
        } else {
            $headOfCommittee = $this->structureService->getStructuresByName('Ketua Komite ' . $beritaAcara->profession->committee->naming())->first()->users->first();
        }

        $pdf = Pdf::loadView('livewire.applications.credential.prints.rekomendasi-penerbitan-penugasa-klinis', [
            'beritaAcara' => $beritaAcara,
            'filing' => $filing,
            'headOfCommittee' => $headOfCommittee,
        ])
        ->setWarnings(false);

        return $pdf->stream("Surat-Rekomendasi-Pernerbitan-Klinis-".time().".pdf");
    }

    public function printClinicalPrivilages(string $id)
    {
        $beritaAcara = $this->competenceBAService->getBAByFilingId($id);

        $filing = $this->filingService->findOrFail($id, ['user']);
        if (!$filing || $filing->status->value < FilingStatus::PEMBERKASAN)
        {
            abort(404);
        }

        $pdf = Pdf::loadView('livewire.applications.credential.prints.clinical-privileges', [
                        'filing' => $filing,
                        'beritaAcara' => $beritaAcara,
                    ])
                    // ->setPaper($this->f4)
                    ->setWarnings(false);

        return $pdf->stream("Clinical-Privileges-".time().".pdf");
    }
}
