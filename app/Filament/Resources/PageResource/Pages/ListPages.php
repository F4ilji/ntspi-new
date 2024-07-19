<?php

namespace App\Filament\Resources\PageResource\Pages;

use App\Filament\Resources\PageResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListPages extends ListRecords
{
    protected static string $resource = PageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }



    public function getTabs(): array
    {
        return [
            'is_created' => Tab::make('Страницы')->modifyQueryUsing(function (Builder $query) {
                $query->where('is_registered', '=', false);
                $query->where('is_url', '=', false);
            }),
            'is_registered' => Tab::make('Зарезервированные страницы')->modifyQueryUsing(function (Builder $query) {
                $query->where('is_registered', '=', true);
                $query->where('is_url', '=', false);
            }),
        ];
    }
}
