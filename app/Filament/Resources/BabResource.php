<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BabResource\Pages;
use App\Filament\Resources\BabResource\RelationManagers;
use App\Models\Bab;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Hugomyb\FilamentMediaAction\Tables\Actions\MediaAction;

class BabResource extends Resource
{
    protected static ?string $model = Bab::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $recordTitleAttribute = 'nama';

    protected static ?string $navigationLabel = 'Bab';

    protected static ?string $slug = 'bab';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\Select::make('kelas_id')
                            ->label('Kelas')
                            ->options(Kelas::all()->pluck('nama', 'id'))
                            ->required()
                            ->searchable(),
                        Forms\Components\Select::make('mata_pelajaran_id')
                            ->label('Mata Pelajaran')
                            ->options(MataPelajaran::all()->pluck('nama', 'id'))
                            ->required()
                            ->searchable(),
                        Forms\Components\Select::make('kode')
                            ->required()
                            ->options([
                                'Bab 1' => 'Bab 1',
                                'Bab 2' => 'Bab 2',
                                'Bab 3' => 'Bab 3',
                                'Bab 4' => 'Bab 4',
                                'Bab 5' => 'Bab 5',
                                'Bab 6' => 'Bab 6',
                                'Bab 7' => 'Bab 7',
                                'Bab 8' => 'Bab 8',
                                'Bab 9' => 'Bab 9',
                                'Bab 10' => 'Bab 10',
                                'Bab 11' => 'Bab 11',
                                'Bab 12' => 'Bab 12',
                                'Bab 13' => 'Bab 13',
                                'Bab 14' => 'Bab 14',
                                'Bab 15' => 'Bab 15',
                                'Bab 16' => 'Bab 16',
                                'Bab 17' => 'Bab 17',
                                'Bab 18' => 'Bab 18',
                                'Bab 19' => 'Bab 19',
                                'Bab 20' => 'Bab 20',
                            ]),
                        Forms\Components\TextInput::make('nama')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\FileUpload::make('gambar')
                            ->image()
                            ->directory('bab')
                            ->visibility('public')
                            ->maxSize(10240)
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg'])
                            ->enableOpen()
                            ->imageEditor()
                            ->enableDownload(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kelas.nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('mataPelajaran.nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kode')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama')
                    ->searchable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kelas_id')
                    ->label('Kelas')
                    ->options(Kelas::all()->pluck('nama', 'id')),
                Tables\Filters\SelectFilter::make('mata_pelajaran_id')
                    ->label('Mata Pelajaran')
                    ->options(MataPelajaran::all()->pluck('nama', 'id')),
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                MediaAction::make('media-url')
                    ->iconButton()
                    ->label('Audio')
                    ->icon('heroicon-o-musical-note')
                    ->media(fn($record) => url('storage/' . $record->audio))
                    ->autoplay(fn($record, $mediaType) => pathinfo($record->audio, PATHINFO_EXTENSION) === 'mp3'),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                ]),
            ])
            ->paginated([25, 50, 100, 'all']);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\MaterisRelationManager::class,
            RelationManagers\UjiKompetensisRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBabs::route('/'),
            'create' => Pages\CreateBab::route('/create'),
            'edit' => Pages\EditBab::route('/{record}/edit'),
        ];
    }
}
