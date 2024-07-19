<?php

namespace App\Filament\Resources\SubSectionResource\Pages;

use App\Filament\Resources\SubSectionResource;
use App\Models\Page;
use App\Models\SubSection;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSubSection extends EditRecord
{
    protected static string $resource = SubSectionResource::class;

    protected array $page_ids = [];

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['page_ids'] = Page::query()->where('sub_section_id', '=', $this->record->id)->pluck('id');

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $this->page_ids = $data['page_ids'];
        unset($data['page_ids']);

        return $data;
    }

    protected function afterSave(): void
    {
        Page::query()->where('sub_section_id', '=', $this->record->id)->update(['sub_section_id' => NULL]);
        Page::whereIn('id', $this->page_ids)->update(['sub_section_id' => $this->record->id]);
        $pages = Page::where('is_url', '=', false)->where('sub_section_id', '=', $this->record->id)->get();


        if (!$pages->isEmpty() && $this->record->mainSection) {
            $mainSectionSlug = $pages[0]->section->mainSection->slug;
            foreach ($pages as $page) {
                if ($page->is_registered != true) {
                    $page->update(['path' => $page->path = $mainSectionSlug . '/' . $this->record->slug . '/' . $page->slug]);
                }
            }
        }


    }


}
