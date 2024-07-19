<?php

namespace App\Filament\Resources\ProgramContestResource\Pages;

use App\Filament\Resources\ProgramContestResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProgramContests extends ListRecords
{
    protected static string $resource = ProgramContestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
