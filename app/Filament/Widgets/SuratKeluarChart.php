<?php

namespace App\Filament\Widgets;

use Flowframe\Trend\Trend;
use App\Models\SuratKeluar;
use Flowframe\Trend\TrendValue;
use Filament\Widgets\ChartWidget;

class SuratKeluarChart extends ChartWidget
{
    protected static ?string $heading = 'Surat Keluar';
    
    protected static ?string $pollingInterval = '10s';

    protected static string $color = 'info';

    protected function getData(): array
    {   
        $data = Trend::model(SuratKeluar::class)
        ->between(
            start: now()->startOfYear(),
            end: now()->endOfYear(),
        )
        ->perMonth()
        ->count();
        return [
            'datasets' => [
                [
                    'label' => 'Surat Keluar',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}