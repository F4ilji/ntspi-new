<?php

namespace App\Filament\Resources\AdditionalEducationResource\Pages;

use App\Filament\Resources\AdditionalEducationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAdditionalEducation extends EditRecord
{
    protected static string $resource = AdditionalEducationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
