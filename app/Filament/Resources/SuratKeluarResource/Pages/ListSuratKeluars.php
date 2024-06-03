<?php

namespace App\Filament\Resources\SuratKeluarResource\Pages;

use App\Filament\Resources\SuratKeluarResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Forms\Components\DatePicker;

class ListSuratKeluars extends ListRecords
{
    protected static string $resource = SuratKeluarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\Action::make('Laporan')->url(fn()=> route('download.laporan-surat-keluar'))->openUrlInNewTab(),
            Actions\Action::make('laporan')
                ->form([
                    DatePicker::make('created_from')
                        ->label('Start')
                        ->default(now())
                        ->required(),
                    DatePicker::make('created_until')
                        ->label('End')
                        ->default(now())
                        ->required(),
                ])
                ->action(function (array $data) {
                    // Eksekusi logika setelah form disubmit
                    $createdFrom = $data['created_from'];
                    $createdUntil = $data['created_until'];
                    // Redirect ke route yang ditentukan dengan parameter tanggal
                    return redirect()->route('download.laporan-surat-keluar', [
                        'created_from' => $createdFrom,
                        'created_until' => $createdUntil,
                    ]);
                }),
            Actions\CreateAction::make()->label(__('Buat Surat Keluar')),
        ];
    }
}