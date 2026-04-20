<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiaporamaSubmitRequest;
use App\Models\DiaporamaReport;
use App\Models\DiaporamaSubmission;
use App\Models\DiaporamaVote;
use App\Services\DiaporamaModerationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Illuminate\View\View;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class DiaporamaController extends Controller
{
    private const VISITOR_COOKIE = 'diaporama_visitor_id';

    private const VISITOR_COOKIE_TTL = 60 * 24 * 365;

    private function resolveVisitorId(): string
    {
        $visitorId = request()->cookie(self::VISITOR_COOKIE);

        if (! $visitorId) {
            $visitorId = (string) Str::uuid();
            Cookie::queue(self::VISITOR_COOKIE, $visitorId, self::VISITOR_COOKIE_TTL);
        }

        return $visitorId;
    }

    public function index(): View
    {
        $visitorId = $this->resolveVisitorId();

        $submission = DiaporamaSubmission::approved()
            ->inRandomOrder()
            ->with('media')
            ->withCount([
                'votes as upvotes_count' => fn($q) => $q->where('vote', 'up'),
                'votes as downvotes_count' => fn($q) => $q->where('vote', 'down'),
            ])
            ->first();

        $userVote = $submission
            ? DiaporamaVote::where('diaporama_submission_id', $submission->id)
                ->where('visitor_id', $visitorId)
                ->value('vote')
            : null;

        return view('diaporama')
            ->with('submission', $submission)
            ->with('userVote', $userVote)
            ->with('seoData', new SEOData(
                title: 'Diaporama',
                description: 'Découvrez les photos soumises par les participants du Concours FVSP 2026 à Coppet.',
            ));
    }

    public function submit(): View
    {
        return view('diaporama_submit')
            ->with('seoData', new SEOData(
                title: 'Soumettre une photo',
                description: 'Soumettez votre photo pour le diaporama du Concours FVSP 2026 à Coppet.',
            ));
    }

    public function store(DiaporamaSubmitRequest $request, DiaporamaModerationService $moderation): RedirectResponse
    {
        try {
            $submission = DiaporamaSubmission::create($request->safe()->only(['name', 'caption']));
            $submission->addMediaFromRequest('photo')->toMediaCollection('photo');
            defer(fn() => $moderation->moderate($submission->fresh(['media'])));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', "Une erreur est survenue lors de l'envoi de votre photo. Veuillez réessayer plus tard.");
        }

        return redirect()->back()->with('success', 'Votre photo a été soumise avec succès ! Elle sera visible après validation par notre équipe.');
    }

    public function vote(Request $request, DiaporamaSubmission $submission): RedirectResponse
    {
        $request->validate(['vote' => 'required|in:up,down']);

        $visitorId = $this->resolveVisitorId();

        DiaporamaVote::updateOrCreate(
            [
                'diaporama_submission_id' => $submission->id,
                'visitor_id' => $visitorId,
            ],
            [
                'ip_address' => $request->ip(),
                'vote' => $request->input('vote'),
            ],
        );

        return redirect()->back();
    }

    public function report(Request $request, DiaporamaSubmission $submission): RedirectResponse
    {
        DiaporamaReport::create([
            'diaporama_submission_id' => $submission->id,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent() ?? '',
            'referer' => $request->headers->get('referer'),
        ]);

        return redirect()->back()->with('reported', true);
    }
}
