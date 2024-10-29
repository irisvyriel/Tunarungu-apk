<?php

namespace App\Filament\Resources\PengaturanResource\Pages;

use App\Filament\Resources\PengaturanResource;
use App\Models\Pengaturan;
use App\Services\TextToSpeechService;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPengaturans extends ListRecords
{
    protected static string $resource = PengaturanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->action(function (array $data): array {
                    $textToSpeech = new TextToSpeechService();

                    $speechResult = $textToSpeech->generateSpeech($data['text']);
                    if ($speechResult['success']) {
                        $data['audio'] = $speechResult['file_name'];
                    }

                    $pengaturan = Pengaturan::create($data);

                    return $pengaturan->toArray();
                }),
        ];
    }
}
