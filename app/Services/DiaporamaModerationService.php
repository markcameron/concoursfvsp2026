<?php

namespace App\Services;

use App\Models\DiaporamaModerationLog;
use App\Models\DiaporamaSubmission;
use App\Models\ModerationSetting;
use Illuminate\Support\Facades\Log;
use OpenAI\Laravel\Facades\OpenAI;

class DiaporamaModerationService
{
    public function moderate(DiaporamaSubmission $submission): string
    {
        $media = $submission->getFirstMedia('photo');

        if (! $media) {
            return 'pending';
        }

        try {
            $base64 = base64_encode(file_get_contents($media->getPath()));
            $dataUrl = "data:{$media->mime_type};base64,{$base64}";

            $response = OpenAI::moderations()->create([
                'model' => 'omni-moderation-latest',
                'input' => [
                    ['type' => 'image_url', 'image_url' => ['url' => $dataUrl]],
                ],
            ]);

            $raw = collect($response->results[0]->categories)
                ->mapWithKeys(fn($c) => [$c->category->value => $c->score])
                ->all();
            $status = $this->determineStatus($raw, ModerationSetting::current());

            $submission->update([
                'status' => $status,
                'moderation_scores' => $raw,
            ]);

            DiaporamaModerationLog::create([
                'diaporama_submission_id' => $submission->id,
                'status' => $status,
                'scores' => $raw,
            ]);

            return $status;
        } catch (\Exception $e) {
            Log::error('Diaporama moderation failed', [
                'submission_id' => $submission->id,
                'error' => $e->getMessage(),
            ]);

            DiaporamaModerationLog::create([
                'diaporama_submission_id' => $submission->id,
                'status' => 'error',
                'error' => $e->getMessage(),
            ]);

            return 'pending';
        }
    }

    private function determineStatus(array $scores, ModerationSetting $setting): string
    {
        $get = fn(string $key): float => (float) ($scores[$key] ?? 0.0);

        $sexual = max($get('sexual'), $get('sexual/minors'));
        $violence = max($get('violence'), $get('violence/graphic'));
        $hate = max($get('hate'), $get('hate/threatening'));
        $harassment = max($get('harassment'), $get('harassment/threatening'));
        $selfHarm = max($get('self-harm'), $get('self-harm/intent'), $get('self-harm/instructions'));
        $illicit = max($get('illicit'), $get('illicit/violent'));

        // Sexual minors has its own low hard threshold
        if ($get('sexual/minors') >= $setting->sexual_minors_reject) {
            return 'rejected';
        }

        if (
            $sexual >= $setting->sexual_reject
            || $violence >= $setting->violence_reject
            || $hate >= $setting->hate_reject
            || $harassment >= $setting->harassment_reject
            || $selfHarm >= $setting->self_harm_reject
            || $illicit >= $setting->illicit_reject
        ) {
            return 'rejected';
        }

        if (
            $sexual >= $setting->sexual_review
            || $violence >= $setting->violence_review
            || $hate >= $setting->hate_review
            || $harassment >= $setting->harassment_review
            || $selfHarm >= $setting->self_harm_review
            || $illicit >= $setting->illicit_review
        ) {
            return 'flagged';
        }

        return 'approved';
    }
}
