<?php

namespace App\Filament\Resources\MainSliderResource\Pages;

use App\Filament\Resources\MainSliderResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMainSlider extends CreateRecord
{
    protected static string $resource = MainSliderResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        unset($data['model_select'], $data['model']);

        return $data;
    }

}
