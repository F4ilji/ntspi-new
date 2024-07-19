<?php

namespace App\Filament\Resources\SubSectionResource\Pages;

use App\Filament\Resources\SubSectionResource;
use App\Models\Page;
use App\Models\SubSection;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateSubSection extends CreateRecord
{
    protected static string $resource = SubSectionResource::class;

    protected array $page_ids;


    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $this->page_ids = $data['page_ids'];
        unset($data['page_ids']);

        return $data;
    }

    protected function afterCreate(): void
    {
        if ($this->page_ids != null) {
            Page::whereIn('id', $this->page_ids)->update(['sub_section_id' => $this->record->id]);

            $pages = Page::where('is_url', '=', false)->where('sub_section_id', '=', $this->record->id)->get();

            if (!$pages->isEmpty()) {
                $mainSectionSlug = ($pages[0]->section->mainSection) ? $pages[0]->section->mainSection->slug : '';


                foreach ($pages as $page) {
                    if ($page->is_registered != true) {
                        $page->update(['path' => $page->path = $mainSectionSlug . '/' . $this->record->slug . '/' . $page->slug]);
                    }
                }
            }
        }

    }

}
