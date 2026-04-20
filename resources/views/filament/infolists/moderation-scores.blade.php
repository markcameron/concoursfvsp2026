@php
    $scores = $getRecord()->moderation_scores ?? [];

    $groups = [
        'Contenu sexuel' => [
            'sexual'        => 'Général',
            'sexual/minors' => 'Mineurs',
        ],
        'Violence' => [
            'violence'         => 'Général',
            'violence/graphic' => 'Graphique',
        ],
        'Haine' => [
            'hate'             => 'Général',
            'hate/threatening' => 'Menaçante',
        ],
        'Harcèlement' => [
            'harassment'             => 'Général',
            'harassment/threatening' => 'Menaçant',
        ],
        'Automutilation' => [
            'self-harm'              => 'Général',
            'self-harm/intent'       => 'Intention',
            'self-harm/instructions' => 'Instructions',
        ],
        'Contenu illicite' => [
            'illicit'         => 'Général',
            'illicit/violent' => 'Violent',
        ],
    ];
@endphp

<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:12px">
    @foreach ($groups as $groupLabel => $keys)
        @php
            $rows = collect($keys)->map(fn($label, $key) => [
                'label' => $label,
                'score' => $scores[$key] ?? null,
            ])->filter(fn($row) => $row['score'] !== null);
        @endphp

        @if ($rows->isNotEmpty())
            <div style="border:1px solid #e5e7eb;border-radius:8px;padding:12px">
                <p style="font-size:0.7rem;font-weight:600;text-transform:uppercase;letter-spacing:0.06em;color:#6b7280;margin-bottom:10px">
                    {{ $groupLabel }}
                </p>

                @foreach ($rows as $row)
                    @php
                        $pct    = number_format($row['score'] * 100, 1);
                        $width  = min((int) round($row['score'] * 100), 100);
                        $colour = match(true) {
                            $row['score'] >= 0.7 => '#ef4444',
                            $row['score'] >= 0.3 => '#f59e0b',
                            default              => '#22c55e',
                        };
                    @endphp
                    <div style="margin-bottom:8px">
                        <div style="display:flex;justify-content:space-between;font-size:0.75rem;margin-bottom:3px;color:#6b7280">
                            <span>{{ $row['label'] }}</span>
                            <span style="font-variant-numeric:tabular-nums">{{ $pct }}%</span>
                        </div>
                        <div style="background:#e5e7eb;border-radius:4px;height:5px">
                            <div style="width:{{ $width }}%;background:{{ $colour }};border-radius:4px;height:5px"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    @endforeach
</div>
