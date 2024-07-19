<?php

namespace App\Filament\Resources\PageResource\Pages;

use App\Filament\Resources\PageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPage extends EditRecord
{
    protected static string $resource = PageResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {

        return $data;
    }


    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        if ($this->record->section != null) {
            $subSection = $this->record->section;
            $MainSection = $subSection->mainSection;

            if ($this->record->is_registered != true) {
                $this->record->update(['path' => $this->record->path = $MainSection->slug . '/' . $subSection->slug . '/' . $this->record->slug]);
            }
        }
    }
}
