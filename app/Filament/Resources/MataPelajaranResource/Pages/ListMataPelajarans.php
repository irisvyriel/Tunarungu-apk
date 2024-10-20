<?php

namespace App\Filament\Resources\MataPelajaranResource\Pages;

use App\Filament\Resources\MataPelajaranResource;
use App\Models\MataPelajaran;
use App\Services\TextToSpeechService;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMataPelajarans extends ListRecords
{
    protected static string $resource = MataPelajaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->action(function (array $data): array {
                    $textToSpeech = new TextToSpeechService();

                    $speechResult = $textToSpeech->generateSpeech("Mata Pelajaran, " . $data['nama']);
                    if ($speechResult['success']) {
                        $data['audio'] = $speechResult['file_name'];
                    }

                    $mataPelajaran = MataPelajaran::create($data);

                    return $mataPelajaran->toArray();
                }),
        ];
    }
}