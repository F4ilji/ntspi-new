<?php

namespace App\Filament\Resources\ProgramContestResource\Pages;

use App\Filament\Resources\ProgramContestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProgramContest extends EditRecord
{
    protected static string $resource = ProgramContestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
