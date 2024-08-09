<?php

namespace App\Filament\Resources\AcademicJournalResource\Pages;

use App\Filament\Resources\AcademicJournalResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAcademicJournals extends ListRecords
{
    protected static string $resource = AcademicJournalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
