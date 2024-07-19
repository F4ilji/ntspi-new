<?php

namespace App\Filament\Resources\AdmissionCampaignResource\Pages;

use App\Filament\Resources\AdmissionCampaignResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAdmissionCampaign extends EditRecord
{
    protected static string $resource = AdmissionCampaignResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
