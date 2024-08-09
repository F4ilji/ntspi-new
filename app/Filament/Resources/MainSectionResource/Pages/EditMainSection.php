<?php

namespace App\Filament\Resources\MainSectionResource\Pages;

use App\Filament\Resources\MainSectionResource;
use App\Models\SubSection;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMainSection extends EditRecord
{
    protected static string $resource = MainSectionResource::class;

    protected array $subSection_ids = [];

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['subSection_ids'] = SubSection::query()->where('main_section_id', '=', $this->record->id)->pluck('id');

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $this->subSection_ids = $data['subSection_ids'];
        unset($data['subSection_ids']);

        return $data;
    }

    protected function afterSave(): void
    {
        SubSection::query()->where('main_section_id', '=', $this->record->id)->update(['main_section_id' => NULL]);
        SubSection::whereIn('id', $this->subSection_ids)->update(['main_section_id' => $this->record->id]);
        $subSections = SubSection::query()->where('main_section_id', '=', $this->record->id)->get();

        foreach ($subSections as $subSection) {
            foreach ($subSection->pages as $page) {
                if ($page->is_registered != true && $page->is_url != true) {
                    $page->update(['path' => $page->path = $this->record->slug.'/'.$subSection->slug.'/'.$page->slug]);
                }
            }

        }
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function hasCombinedRelationManagerTabsWithContent(): bool
    {
        return true;
    }
}
