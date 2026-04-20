<?php

namespace App\Console\Commands;

use App\Models\DiaporamaSubmission;
use App\Services\DiaporamaModerationService;
use Illuminate\Console\Command;

class ModerateDiaporamaSubmissions extends Command
{
    protected $signature = 'app:moderate-diaporama-submissions';

    protected $description = 'Run AI moderation on pending diaporama submissions';

    public function handle(DiaporamaModerationService $moderation): void
    {
        DiaporamaSubmission::pending()
            ->with('media')
            ->each(fn(DiaporamaSubmission $submission) => $moderation->moderate($submission));
    }
}
