<?php

namespace App\Filament\Resources\EducationalProgramResource\Pages;

use App\Filament\Resources\EducationalProgramResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEducationalProgram extends EditRecord
{
    protected static string $resource = EducationalProgramResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
