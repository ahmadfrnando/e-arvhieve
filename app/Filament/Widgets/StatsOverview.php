<?php

namespace App\Filament\Widgets;

use App\Models\Dinas;
use App\Models\SuratMasuk;
use App\Models\SuratKeluar;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Surat Masuk', SuratMasuk::count()),
            Stat::make('Total Surat Keluar', SuratKeluar::count()),
            Stat::make('Total Dinas', Dinas::count()),
        ];
    }
}