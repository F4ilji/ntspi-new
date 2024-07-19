<?php

namespace App\Filament\Resources\ExternalVacancyResource\Pages;

use App\Filament\Resources\ExternalVacancyResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListExternalVacancies extends ListRecords
{
    protected static string $resource = ExternalVacancyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
