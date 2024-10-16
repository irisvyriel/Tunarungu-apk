<?php

namespace App\Filament\Resources\UjiKompetensiResource\Pages;

use App\Filament\Resources\UjiKompetensiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUjiKompetensi extends EditRecord
{
    protected static string $resource = UjiKompetensiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
