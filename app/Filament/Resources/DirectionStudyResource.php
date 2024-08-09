<?php

namespace App\Filament\Resources;

use App\Enums\LevelEducational;
use App\Filament\Resources\DirectionStudyResource\Pages;
use App\Filament\Resources\DirectionStudyResource\RelationManagers;
use App\Models\DirectionStudy;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class DirectionStudyResource extends Resource
{
    protected static ?string $model = DirectionStudy::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $pluralLabel = 'Направление подготовки';

    protected static ?string $navigationParentItem = 'Приемная-компания';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('code'),
                Tables\Columns\TextColumn::make('lvl_edu')
                    ->formatStateUsing(fn ($state) => $state->getLabel())
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDirectionStudies::route('/'),
            'create' => Pages\CreateDirectionStudy::route('/create'),
            'edit' => Pages\EditDirectionStudy::route('/{record}/edit'),
        ];
    }
}
