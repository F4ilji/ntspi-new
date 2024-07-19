<?php

namespace App\Filament\Resources\DirectionStudyResource\Pages;

use App\Filament\Resources\DirectionStudyResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDirectionStudy extends EditRecord
{
    protected static string $resource = DirectionStudyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
