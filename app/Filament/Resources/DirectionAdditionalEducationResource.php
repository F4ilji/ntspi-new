<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DirectionAdditionalEducationResource\Pages;
use App\Filament\Resources\DirectionAdditionalEducationResource\RelationManagers;
use App\Models\DirectionAdditionalEducation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DirectionAdditionalEducationResource extends Resource
{
    protected static ?string $model = DirectionAdditionalEducation::class;

    public static ?string $label = 'Направление';
    protected static ?string $pluralLabel = 'Направления дополнительного образования';
    protected static ?string $navigationParentItem = 'Дополнительное Образование';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')->required()->columnSpanFull(),
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
            'index' => Pages\ListDirectionAdditionalEducation::route('/'),
            'create' => Pages\CreateDirectionAdditionalEducation::route('/create'),
            'edit' => Pages\EditDirectionAdditionalEducation::route('/{record}/edit'),
        ];
    }
}
