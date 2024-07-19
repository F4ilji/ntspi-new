<?php

namespace App\Filament\Resources\ExternalVacancyResource\Pages;

use App\Filament\Resources\ExternalVacancyResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditExternalVacancy extends EditRecord
{
    protected static string $resource = ExternalVacancyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
