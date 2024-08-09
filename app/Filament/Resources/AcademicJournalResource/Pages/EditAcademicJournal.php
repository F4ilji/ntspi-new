<?php

namespace App\Filament\Resources\AcademicJournalResource\Pages;

use App\Filament\Resources\AcademicJournalResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAcademicJournal extends EditRecord
{
    protected static string $resource = AcademicJournalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
