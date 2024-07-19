<?php

namespace App\Filament\Resources\AdditionalEducationCategoryResource\Pages;

use App\Filament\Resources\AdditionalEducationCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAdditionalEducationCategories extends ListRecords
{
    protected static string $resource = AdditionalEducationCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
