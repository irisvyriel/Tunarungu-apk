<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MataPelajaranResource\Pages;
use App\Models\MataPelajaran;
use App\Services\TextToSpeechService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Hugomyb\FilamentMediaAction\Tables\Actions\MediaAction;

class MataPelajaranResource extends Resource
{
    protected static ?string $model = MataPelajaran::class;

        protected static ?string $navigationIcon = 'heroicon-o-book-open';

        protected static ?string $recordTitleAttribute = 'nama';

        protected static ?string $navigationLabel = 'Mata Pelajaran';

        protected static ?string $slug = 'mata-pelajaran';

        protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                Forms\Components\FileUpload::make('gambar')
                    ->image()
                    ->directory('mata-pelajaran')
                    ->visibility('public')
                    ->maxSize(10240)
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg'])
                    ->enableOpen()
                    ->imageEditor()
                    ->enableDownload(),
            ]);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('gambar')
                    ->width(200)
                    ->height("auto"),
                Tables\Columns\TextColumn::make('nama')
                    ->searchable(),
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

                Tables\Actions\EditAction::make()
                    ->action(function ($record, array $data) {
                        $textToSpeech = new TextToSpeechService();

                        if ($record->audio) {
                            $textToSpeech->deleteSpeech($record->audio);
                        }

                        $speechResult = $textToSpeech->generateSpeech("Mata Pelajaran, " . $data['nama']);
                        if ($speechResult['success']) {
                            $record->audio = $speechResult['file_name'];
                        }

                        $record->fill($data);

                        $record->save();

                        Notification::make()
                            ->title('Data berhasil diperbarui')
                            ->success()
                            ->send();
                    }),

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
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMataPelajarans::route('/'),
        ];
    }
}