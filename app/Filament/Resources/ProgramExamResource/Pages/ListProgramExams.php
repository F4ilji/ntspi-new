<?php

namespace App\Filament\Resources\ProgramExamResource\Pages;

use App\Filament\Resources\ProgramExamResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProgramExams extends ListRecords
{
    protected static string $resource = ProgramExamResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
