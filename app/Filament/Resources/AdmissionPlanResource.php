<?php

namespace App\Filament\Resources;

use App\Enums\EducationalProgramStatus;
use App\Filament\Resources\AdmissionPlanResource\Pages;
use App\Filament\Resources\AdmissionPlanResource\RelationManagers;
use App\Filament\Resources\EducationalProgramResource\RelationManagers\AdmissionPlansRelationManager;
use App\Models\AdmissionCampaign;
use App\Models\AdmissionPlan;
use App\Models\EducationalProgram;
use Filament\Forms;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class AdmissionPlanResource extends Resource
{
    protected static ?string $model = AdmissionPlan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


    protected static ?string $pluralLabel = 'План приема';

    protected static ?string $navigationParentItem = 'Приемная-компания';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('educational_programs_id')
                    ->searchable()
                    ->label('Образовательная программа')
                    ->options(EducationalProgram::whereIn('status', [EducationalProgramStatus::PUBLISHED, EducationalProgramStatus::IN_PROGRESS])->pluck('name', 'id')),
                Forms\Components\Select::make('admission_campaigns_id')
                    ->label('Приемная компания')
                    ->options(AdmissionCampaign::all()->pluck('name', 'id')),
                Section::make('План приема')->schema([
                    Forms\Components\Repeater::make('exams')->label('Вступительные испытания')->schema([
                        TextInput::make('title')->label('Название-предмета'),
                        Forms\Components\Select::make('type_exam')->label('Тип-ВИ')
                        ->options(['ege' => 'ЕГЭ', 'internal_test' => 'ВИ, проводимое организацией самостоятельно']),
                        TextInput::make('min_score')->label('Минимальный-балл')->integer()
                    ])->live()->maxItems(2)->collapsed()->addActionLabel('Добавить вступительное испытание')->columns(3)                                ->itemLabel(function (Get $get) {
                        static $count = 0;
                        $maxCount = count($get('exams'));
                        $count = ($count++ <= $maxCount) ? $count : 1;
                        return "Вступительное испытание #" . $count;
                    }),
                    Forms\Components\Repeater::make('contests')->label('Условия поступления')->schema([
                        Forms\Components\Select::make('form_education')->label('Форма образования')
                            ->options(['och' => 'Очная форма обучения', 'zaoch' => 'Заочная форма обучения', 'och_zaoch' => 'Очно-заочная форма обучения']),
                        Forms\Components\Select::make('financing_source')->label('Источник финансирования')
                            ->options(['budget' => 'Бюджетное место', 'non_budget' => 'С оплатой обучения']),
                        TextInput::make('budget_quantity_position')->label('Количество бюджетных мест')->integer(),
                        TextInput::make('non_budget_quantity_position')->label('Количество платных мест')->integer()
                    ])->live()->maxItems(2)->collapsed()->addActionLabel('Добавить группу')->columns(3)
                        ->itemLabel(function (Get $get) {
                        static $count = 0;
                        $maxCount = count($get('contests'));
                        $count = ($count++ <= $maxCount) ? $count : 1;
                        return "Группа #" . $count;
                    }),

                ]),

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

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAdmissionPlans::route('/'),
            'create' => Pages\CreateAdmissionPlan::route('/create'),
            'edit' => Pages\EditAdmissionPlan::route('/{record}/edit'),
        ];
    }
}
