<?php

namespace App\Filament\Resources\BabResource\Pages;

use App\Filament\Resources\BabResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBabs extends ListRecords
{
    protected static string $resource = BabResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
