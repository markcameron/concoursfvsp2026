<?php

namespace App\Filament\Resources\QrCodeResource\Widgets;

use App\Models\QrCode;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class QrVisitsChart extends ChartWidget
{
    public QrCode $record;

    protected static ?string $heading = 'Visites';

    public ?string $filter = '30';

    protected static ?string $pollingInterval = null;

    protected function getFilters(): ?array
    {
        return [
            '7' => '7 derniers jours',
            '30' => '30 derniers jours',
            '90' => '90 derniers jours',
        ];
    }

    protected function getData(): array
    {
        $days = (int) $this->filter;
        $start = Carbon::now()->subDays($days - 1)->startOfDay();

        $visits = $this->record->visits()
            ->where('created_at', '>=', $start)
            ->get()
            ->groupBy(fn($visit) => Carbon::parse($visit->created_at)->format('Y-m-d'));

        $labels = [];
        $data = [];

        for ($i = $days - 1; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $labels[] = Carbon::parse($date)->format('d.m');
            $data[] = $visits->get($date, collect())->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'Visites',
                    'data' => $data,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
