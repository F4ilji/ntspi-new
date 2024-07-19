<?php

namespace App\Filament\Resources\LibraryNewsResource\Pages;

use App\Filament\Resources\LibraryNewsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLibraryNews extends EditRecord
{
    protected static string $resource = LibraryNewsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
