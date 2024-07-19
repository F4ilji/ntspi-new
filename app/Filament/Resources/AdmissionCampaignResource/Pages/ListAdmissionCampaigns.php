<?php

namespace App\Filament\Resources\AdmissionCampaignResource\Pages;

use App\Filament\Resources\AdmissionCampaignResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAdmissionCampaigns extends ListRecords
{
    protected static string $resource = AdmissionCampaignResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
