<?php

namespace App\Filament\Resources\VacantPositionResource\Pages;

use App\Filament\Resources\VacantPositionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVacantPositions extends ListRecords
{
    protected static string $resource = VacantPositionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
