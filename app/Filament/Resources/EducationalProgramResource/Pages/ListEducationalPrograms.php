<?php

namespace App\Filament\Resources\EducationalProgramResource\Pages;

use App\Enums\EducationalProgramStatus;
use App\Enums\PostStatus;
use App\Filament\Resources\EducationalProgramResource;
use App\Models\EducationalProgram;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class ListEducationalPrograms extends ListRecords
{
    protected static string $resource = EducationalProgramResource::class;

    public \Illuminate\Support\Collection $programByStatuses;

    public function __construct()
    {
        $this->programByStatuses = EducationalProgram::select('status', DB::raw('count(*) as program_count'))
            ->groupBy('status')
            ->pluck('program_count', 'status');
    }


    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'status' => Tab::make('Опубликованные программы')->modifyQueryUsing(function (Builder $query) {
                $query->where('status', '=', EducationalProgramStatus::PUBLISHED->value);
            })->badge($this->programByStatuses[EducationalProgramStatus::PUBLISHED->value] ?? 0),
            'All' => Tab::make('Все программы'),
        ];
    }
}
