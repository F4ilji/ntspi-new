<?php

namespace App\Filament\Resources\AdmissionPlanResource\Pages;

use App\Filament\Resources\AdmissionPlanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAdmissionPlan extends EditRecord
{
    protected static string $resource = AdmissionPlanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
