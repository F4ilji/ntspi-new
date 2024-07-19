<?php

namespace App\Filament\Resources\VacantPositionResource\Pages;

use App\Filament\Resources\VacantPositionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVacantPosition extends EditRecord
{
    protected static string $resource = VacantPositionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
