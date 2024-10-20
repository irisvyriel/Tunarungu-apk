<?php

namespace App\Filament\Resources\BabResource\Pages;

use App\Filament\Resources\BabResource;
use App\Models\Bab;
use App\Services\TextToSpeechService;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateBab extends CreateRecord
{
    protected static string $resource = BabResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function handleRecordCreation(array $data): Model
    {
        $textToSpeech = new TextToSpeechService();
        $convertTextToSpeech = $textToSpeech->generateSpeech($data['kode'] . "," . $data['nama']);

        $bab = Bab::create([
            'mata_pelajaran_id' => $data['mata_pelajaran_id'],
            'kelas_id' => $data['kelas_id'],
            'gambar' => $data['gambar'] ?? null,
            'kode' => $data['kode'],
            'nama' => $data['nama'],
            'audio' => $convertTextToSpeech['file_name'] ?? null,
        ]);

        return $bab;
    }
}
