<?php

namespace App\Filament\Resources\DirectionStudyResource\Pages;

use App\Filament\Resources\DirectionStudyResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDirectionStudies extends ListRecords
{
    protected static string $resource = DirectionStudyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
