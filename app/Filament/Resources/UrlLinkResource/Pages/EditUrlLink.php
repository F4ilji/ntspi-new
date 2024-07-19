<?php

namespace App\Filament\Resources\UrlLinkResource\Pages;

use App\Filament\Resources\UrlLinkResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUrlLink extends EditRecord
{
    protected static string $resource = UrlLinkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
