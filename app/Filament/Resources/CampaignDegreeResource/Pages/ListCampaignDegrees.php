<?php

namespace App\Filament\Resources\CampaignDegreeResource\Pages;

use App\Filament\Resources\CampaignDegreeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCampaignDegrees extends ListRecords
{
    protected static string $resource = CampaignDegreeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
