<?php

namespace App\Filament\Resources\DirectionAdditionalEducationResource\Pages;

use App\Filament\Resources\DirectionAdditionalEducationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDirectionAdditionalEducation extends ListRecords
{
    protected static string $resource = DirectionAdditionalEducationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
