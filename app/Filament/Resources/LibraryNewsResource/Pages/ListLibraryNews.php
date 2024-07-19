<?php

namespace App\Filament\Resources\LibraryNewsResource\Pages;

use App\Filament\Resources\LibraryNewsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLibraryNews extends ListRecords
{
    protected static string $resource = LibraryNewsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
