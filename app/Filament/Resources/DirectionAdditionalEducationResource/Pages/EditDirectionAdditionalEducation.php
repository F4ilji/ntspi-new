<?php

namespace App\Filament\Resources\DirectionAdditionalEducationResource\Pages;

use App\Filament\Resources\DirectionAdditionalEducationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDirectionAdditionalEducation extends EditRecord
{
    protected static string $resource = DirectionAdditionalEducationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
