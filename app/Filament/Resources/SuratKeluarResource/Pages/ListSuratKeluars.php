<?php

namespace App\Filament\Resources\SuratKeluarResource\Pages;

use App\Filament\Resources\SuratKeluarResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSuratKeluars extends ListRecords
{
    protected static string $resource = SuratKeluarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('Laporan')->url(fn()=> route('download.laporan-surat-keluar'))->openUrlInNewTab(),
            Actions\CreateAction::make(),
        ];
    }
}