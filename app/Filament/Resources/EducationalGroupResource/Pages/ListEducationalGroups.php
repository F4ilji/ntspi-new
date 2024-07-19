<?php

namespace App\Filament\Resources\EducationalGroupResource\Pages;

use App\Filament\Resources\EducationalGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEducationalGroups extends ListRecords
{
    protected static string $resource = EducationalGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
