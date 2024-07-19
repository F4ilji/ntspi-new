<?php

namespace App\Filament\Resources\SubSectionResource\Pages;

use App\Filament\Resources\SubSectionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSubSections extends ListRecords
{
    protected static string $resource = SubSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
