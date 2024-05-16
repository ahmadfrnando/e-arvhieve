<?php

namespace App\Filament\Resources;

use Filament\Tables;
use App\Models\Dinas;
use Filament\Forms\Form;
use App\Models\SuratMasuk;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\SuratMasukResource\Pages;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class SuratMasukResource extends Resource
{
    protected static ?string $model = SuratMasuk::class;

    protected static ?string $navigationIcon = 'heroicon-c-inbox-stack';

    protected static ?string $navigationLabel = 'Surat Masuk';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nosurat')->label('Nomor Surat')->required(),
                TextInput::make('subjek')->required(),
                Select::make('pengirim')->required()
                    ->options(Dinas::pluck('namadinas', 'namadinas'))
                    ->searchable(),
                FileUpload::make('file')->required()
                    ->label('Unggah Surat')
                    ->disk('public')
                    ->directory('surat-masuk')
                    ->getUploadedFileNameForStorageUsing(
                        fn (TemporaryUploadedFile $file): string => (string) str($file->getClientOriginalName())
                            ->prepend('Surat-Masuk-'),
                    )
                    ->uploadingMessage('Mengunggah berkas...')
                    ->acceptedFileTypes(['application/pdf'])
                    ->maxSize(1024)
                    ->downloadable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nosurat')->label('No. Surat')->searchable(),
                TextColumn::make('subjek')->wrap()->searchable(),
                TextColumn::make('pengirim')->searchable(),
                TextColumn::make('created_at')->label('Tanggal Masuk'),
                TextColumn::make('status')
                    ->label('Status')
                    // ->icon(fn (string  $state): string => match ($state) {
                    //     'rejected' => 'heroicon-o-x-circle',
                    //     'pending' => 'heroicon-o-clock',
                    //     'accepted' => 'heroicon-o-check-circle',
                    // })
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Diproses' => 'warning',
                        'Ditindaklanjutin' => 'success',
                        'Disesuaikan' => 'info',
                        'Ditolak' => 'danger',
                        default => 'gray',
                    })
            ])->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'Diproses' => 'Diproses',
                        'Ditindaklanjutin' => 'Ditindaklanjutin',
                        'Disesuaikan' => 'Disesuaikan',
                        'Ditolak' => 'Ditolak',
                    ]),
                Filter::make('created_at')
                    ->label('Tgl. Masuk')
                    ->form([
                        DatePicker::make('created_from'),
                        DatePicker::make('created_until')->default(now()),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
            ])
            ->actions([
                Tables\Actions\EditAction::make()->hidden(fn () => !auth()->user()->isAdmin),
                Tables\Actions\Action::make('update')
                    ->icon('heroicon-c-arrow-path')
                    ->color('warning')
                    ->form([
                        Select::make('status')
                            ->options([
                                'Diproses' => 'Diproses',
                                'Ditindaklanjutin' => 'Ditindaklanjutin',
                                'Disesuaikan' => 'Disesuaikan',
                                'Ditolak' => 'Ditolak',
                            ])
                            ->required(),
                    ])
                    ->action(function (array $data, SuratMasuk $record): void {
                        $record->status = $data['status'];
                        $record->save();
                    })
                    ->hidden(fn () => auth()->user()->isAdmin),
                Tables\Actions\Action::make('delete')
                    ->hidden(fn () => !auth()->user()->isAdmin)
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->action(fn (SuratMasuk $record) => $record->delete())
                    ->requiresConfirmation(),
                Tables\Actions\Action::make('download')
                    ->icon('heroicon-c-arrow-down-tray')
                    ->color('info')
                    ->url(
                        fn (SuratMasuk $record): string => route('download.surat-masuk', ['record' => $record]),
                        shouldOpenInNewTab: true
                    )
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSuratMasuks::route('/'),
            'create' => Pages\CreateSuratMasuk::route('/create'),
            'view' => Pages\ViewSuratMasuk::route('/{record}'),
            'edit' => Pages\EditSuratMasuk::route('/{record}/edit'),
        ];
    }
}