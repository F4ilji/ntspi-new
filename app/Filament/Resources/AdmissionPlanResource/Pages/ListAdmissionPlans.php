<?php

namespace App\Filament\Resources\AdmissionPlanResource\Pages;

use App\Filament\Resources\AdmissionPlanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAdmissionPlans extends ListRecords
{
    protected static string $resource = AdmissionPlanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
