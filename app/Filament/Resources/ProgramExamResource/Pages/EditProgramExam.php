<?php

namespace App\Filament\Resources\ProgramExamResource\Pages;

use App\Filament\Resources\ProgramExamResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProgramExam extends EditRecord
{
    protected static string $resource = ProgramExamResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
