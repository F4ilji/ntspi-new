<?php

namespace App\Filament\Resources\UrlLinkResource\Pages;

use App\Filament\Resources\UrlLinkResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListUrlLinks extends ListRecords
{
    protected static string $resource = UrlLinkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'is_url' => Tab::make('Ссылки')->modifyQueryUsing(function (Builder $query) {
                $query->where('is_url', '=', true);
            }),
        ];
    }
}
