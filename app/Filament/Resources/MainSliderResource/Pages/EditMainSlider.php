<?php

namespace App\Filament\Resources\MainSliderResource\Pages;

use App\Filament\Resources\MainSliderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMainSlider extends EditRecord
{
    protected static string $resource = MainSliderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        unset($data['model_select'], $data['model']);

        return $data;
    }
}
