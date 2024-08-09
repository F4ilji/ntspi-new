<?php

namespace App\Filament\Resources\JournalIssueResource\Pages;

use App\Filament\Resources\JournalIssueResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJournalIssues extends ListRecords
{
    protected static string $resource = JournalIssueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
