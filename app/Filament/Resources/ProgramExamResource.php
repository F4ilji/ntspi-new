<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProgramExamResource\Pages;
use App\Filament\Resources\ProgramExamResource\RelationManagers;
use App\Models\ProgramExam;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProgramExamResource extends Resource
{
    protected static ?string $model = ProgramExam::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $pluralLabel = 'Вступительные испытания';

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
                Tables\Columns\TextColumn::make('type'),
                Tables\Columns\TextColumn::make('is_profile_direction'),
                Tables\Columns\TextColumn::make('min_ball'),
                Tables\Columns\TextColumn::make('max_ball'),
                Tables\Columns\TextColumn::make('form_exam'),
                Tables\Columns\TextColumn::make('language'),


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
            'index' => Pages\ListProgramExams::route('/'),
            'create' => Pages\CreateProgramExam::route('/create'),
            'edit' => Pages\EditProgramExam::route('/{record}/edit'),
        ];
    }
}
