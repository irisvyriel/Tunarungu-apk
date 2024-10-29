<?php

namespace App\Filament\Resources\BabResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Hugomyb\FilamentMediaAction\Tables\Actions\MediaAction;

class MaterisRelationManager extends RelationManager
{
    protected static string $relationship = 'materis';

    protected static ?string $title = 'Materi';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('judul')
                    ->required(),
                Forms\Components\RichEditor::make('materi')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('audio')
                    ->visibility('public')
                    ->required(fn($record) => $record === null)
                    ->enableOpen()
                    ->columnSpanFull()
                    ->enableDownload(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('judul')
            ->columns([
                Tables\Columns\TextColumn::make('judul'),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->filters([
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
}