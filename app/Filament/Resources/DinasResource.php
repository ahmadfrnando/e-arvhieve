<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DinasResource\Pages;
use App\Models\Dinas;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DinasResource extends Resource
{
    protected static ?string $model = Dinas::class;

    protected static ?string $navigationIcon = 'heroicon-c-rectangle-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('namadinas')->label('Nama Dinas')->required(),
                TextInput::make('email')->required(),
                TextInput::make('notel')->label('No. Telp')->required(),
                TextInput::make('alamat')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('namadinas')->label('Nama Dinas')->searchable(),
                TextColumn::make('email')->searchable(),
                TextColumn::make('alamat')->searchable(),
                TextColumn::make('notel')->label('No. Telp')->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('delete')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->action(fn (Dinas $record) => $record->delete())
                    ->requiresConfirmation(),
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
            'index' => Pages\ListDinas::route('/'),
            'create' => Pages\CreateDinas::route('/create'),
            'edit' => Pages\EditDinas::route('/{record}/edit'),
        ];
    }
}