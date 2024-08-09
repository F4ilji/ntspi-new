<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdditionalEducationCategoryResource\Pages;
use App\Filament\Resources\AdditionalEducationCategoryResource\RelationManagers;
use App\Models\AdditionalEducationCategory;
use App\Models\DirectionAdditionalEducation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AdditionalEducationCategoryResource extends Resource
{
    protected static ?string $model = AdditionalEducationCategory::class;


    public static ?string $label = 'Категория';
    protected static ?string $pluralLabel = 'Категории дополнительного образования';
    protected static ?string $navigationParentItem = 'Дополнительное Образование';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make('2')->schema([
                    Forms\Components\TextInput::make('title')->required(),
                    Forms\Components\Select::make('dir_addit_educat_id')->required()
                        ->options(DirectionAdditionalEducation::where('is_active', true)->pluck('title', 'id'))
                ]),
                Forms\Components\Toggle::make('is_active')->columnSpanFull()->inline(false)->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListAdditionalEducationCategories::route('/'),
            'create' => Pages\CreateAdditionalEducationCategory::route('/create'),
            'edit' => Pages\EditAdditionalEducationCategory::route('/{record}/edit'),
        ];
    }
}
