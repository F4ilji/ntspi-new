<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubSectionResource\Pages;
use App\Filament\Resources\SubSectionResource\RelationManagers;
use App\Models\Page;
use App\Models\SubSection;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class SubSectionResource extends Resource
{
    protected static ?string $model = SubSection::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $pluralLabel = 'Подразделы';
    protected static ?string $navigationParentItem = 'Страницы';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')->label('Название подраздела')->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (string $operation, string $state, Forms\Set $set) {
                        $set('slug', Str::slug($state));
                    }),
                TextInput::make('slug')->label('Slug')->unique(ignoreRecord: true)->readOnly()->required(),

                Forms\Components\Select::make('page_ids')->options(
                    Page::query()->when(function ($query) {
                        $query->where('is_visible', true);
                        $query->where('title', '!=', null);
                    })->get()->pluck('title', 'id')
                )->multiple()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
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
            'index' => Pages\ListSubSections::route('/'),
            'create' => Pages\CreateSubSection::route('/create'),
            'edit' => Pages\EditSubSection::route('/{record}/edit'),
        ];
    }
}
