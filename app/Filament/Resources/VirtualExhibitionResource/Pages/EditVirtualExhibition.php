<?php

namespace App\Filament\Resources\VirtualExhibitionResource\Pages;

use App\Filament\Resources\VirtualExhibitionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVirtualExhibition extends EditRecord
{
    protected static string $resource = VirtualExhibitionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
