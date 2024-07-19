<?php

namespace App\Filament\Resources\VirtualExhibitionResource\Pages;

use App\Filament\Resources\VirtualExhibitionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVirtualExhibitions extends ListRecords
{
    protected static string $resource = VirtualExhibitionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
