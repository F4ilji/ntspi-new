<?php

namespace App\Filament\Resources\AdditionalEducationResource\Pages;

use App\Filament\Resources\AdditionalEducationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAdditionalEducation extends ListRecords
{
    protected static string $resource = AdditionalEducationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
