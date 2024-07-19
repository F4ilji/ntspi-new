<?php

namespace App\Filament\Resources\PageResource\Pages;

use App\Filament\Resources\PageResource;
use App\Models\SubSection;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePage extends CreateRecord
{
    protected static string $resource = PageResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $subSection = SubSection::find($data['sub_section_id']);
        if ($subSection != null) {
            $data['path'] = $subSection->mainSection->slug . '/' . $subSection->slug . '/' . $data['slug'];
        } else {
            $data['path'] = $data['slug'];
        }
        unset($data['sub_section_id']);

        return $data;
    }
}
