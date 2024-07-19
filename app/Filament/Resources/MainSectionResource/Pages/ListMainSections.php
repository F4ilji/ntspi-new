<?php

namespace App\Filament\Resources\MainSectionResource\Pages;

use App\Filament\Resources\MainSectionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMainSections extends ListRecords
{
    protected static string $resource = MainSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
