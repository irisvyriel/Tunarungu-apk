<?php

namespace App\Filament\Resources\BabResource\Pages;

use App\Filament\Resources\BabResource;
use App\Services\TextToSpeechService;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditBab extends EditRecord
{
    protected static string $resource = BabResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $textToSpeech = new TextToSpeechService();
        $convertTextToSpeech = $textToSpeech->generateSpeech($data['kode'] . "," . $data['nama']);
        $data['audio'] = $convertTextToSpeech['file_name'] ?? null;

        $record->update($data);
        return $record;
    }
}
