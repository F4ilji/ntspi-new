<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Enums\PostStatus;
use App\Filament\Resources\PostResource;
use App\Models\Post;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class ListPosts extends ListRecords
{
    public \Illuminate\Support\Collection $postsByStatuses;

    public function __construct()
    {
        $this->postsByStatuses = Post::select('status', DB::raw('count(*) as post_count'))
            ->groupBy('status')
            ->pluck('post_count', 'status');
    }

    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'status' => Tab::make('Новости на рассмотрении')->modifyQueryUsing(function (Builder $query) {
                $query->where('status', '=', PostStatus::VERIFICATION->value);
            })->badge($this->postsByStatuses[PostStatus::VERIFICATION->value] ?? 0),
            'All' => Tab::make('Все новости'),
        ];
    }
}
