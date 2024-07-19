<?php

namespace App\Filament\Resources\MainSectionResource\Pages;

use App\Filament\Resources\MainSectionResource;
use App\Models\MainSection;
use App\Models\SubSection;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMainSection extends CreateRecord
{
    protected static string $resource = MainSectionResource::class;

    protected array $subSection_ids;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $this->subSection_ids = $data['subSection_ids'];
        unset($data['subSection_ids']);

        return $data;
    }

    protected function afterCreate(): void
    {
        SubSection::whereIn('id', $this->subSection_ids)->update(['main_section_id' => $this->record->id]);
        $subSections = SubSection::query()->where('main_section_id', '=', $this->record->id)->get();

        foreach ($subSections as $subSection) {
            foreach ($subSection->pages as $page) {
                if ($page->is_registered != true && $page->is_url != true) {
                    $page->update(['path' => $page->path = $this->record->slug.'/'.$subSection->slug.'/'.$page->path]);
                }
            }
        }
    }
}
