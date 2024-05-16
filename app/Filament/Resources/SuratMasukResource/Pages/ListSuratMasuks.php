<?php

namespace App\Filament\Resources\SuratMasukResource\Pages;

use App\Filament\Resources\SuratMasukResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSuratMasuks extends ListRecords
{
    protected static string $resource = SuratMasukResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('Laporan')->url(fn()=> route('download.laporan-surat-masuk'))->openUrlInNewTab(),
            Actions\CreateAction::make(),
        ];
    }
}