<?php

namespace App\Filament\Resources;

use App\Models\Bab;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\UjiKompetensi;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UjiKompetensiResource\Pages;
use App\Filament\Resources\UjiKompetensiResource\RelationManagers;

class UjiKompetensiResource extends Resource
{
    protected static ?string $model = UjiKompetensi::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $recordTitleAttribute = 'soal';

    protected static ?string $navigationLabel = 'Uji Kompetensi';

    protected static ?string $slug = 'uji-kompetensi';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('bab_id')
                    ->label('Bab')
                    ->options(Bab::all()->pluck('nama', 'id'))
                    ->required()
                    ->searchable(),
                Forms\Components\TextInput::make('soal')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('tipe')
                    ->options([
                        'Pilihan Ganda' => 'Pilihan Ganda', 
                        'Essay' => 'Essay' 
                    ])
                    ->required(),
                // Forms\Components\TextInput::make('data'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('bab.nama')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('soal')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tipe'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListUjiKompetensis::route('/'),
        ];
    }
}
