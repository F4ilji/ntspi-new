<?php

namespace App\Filament\Resources\EducationalProgramResource\Pages;

use App\Filament\Resources\EducationalProgramResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEducationalPrograms extends ListRecords
{
    protected static string $resource = EducationalProgramResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
