<?php

namespace App\Filament\Widgets;

use App\Models\SuratMasuk;
use Flowframe\Trend\Trend;
use Illuminate\Support\Carbon;
use Flowframe\Trend\TrendValue;
use Filament\Widgets\ChartWidget;

class SuratMasukChart extends ChartWidget
{
    protected static ?string $heading = 'Surat Masuk';
    
    protected static ?string $pollingInterval = '10s';


    protected function getData(): array
    {
        $data = Trend::model(SuratMasuk::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();
        return [
            'datasets' => [
                [
                    'label' => 'Surat Masuk',
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