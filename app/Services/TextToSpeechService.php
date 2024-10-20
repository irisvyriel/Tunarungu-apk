<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class TextToSpeechService
{
    public function generateSpeech($text, $language = 'id-ID')
    {
        $encodedText = rawurlencode($text);
        $url = "https://translate.google.com/translate_tts?ie=UTF-8&client=gtx&q={$encodedText}&tl={$language}";

        $response = Http::get($url);

        if ($response->successful()) {
            $fileName = uniqid() . '_' . time() . '.mp3';
            Storage::disk('public')->put($fileName, $response->body());

            return [
                'success' => true,
                'file_name' => $fileName,
            ];
        }

        return [
            'success' => false,
            'message' => 'Failed to generate text-to-speech audio',
        ];
    }

    public function deleteSpeech($fileName)
    {
        if (Storage::disk('public')->exists($fileName)) {
            Storage::disk('public')->delete($fileName);
        }
    }
}
