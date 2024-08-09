<?php

namespace App\Filament\Resources\EducationalProgramResource\RelationManagers;

use App\Enums\EducationalProgramStatus;
use App\Models\AdmissionCampaign;
use App\Models\EducationalProgram;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AdmissionPlansRelationManager extends RelationManager
{
    protected static string $relationship = 'admission_plans';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('admission_campaigns_id')
                    ->label('Приемная компания')
                    ->required()
                    ->options(AdmissionCampaign::all()->pluck('name', 'id')),
                Section::make('План приема')->schema([
                    Forms\Components\Repeater::make('exams')->label('Вступительные испытания')->schema([
                        TextInput::make('title')->label('Название-предмета')->required(),
                        Forms\Components\Select::make('type_exam')->label('Тип-ВИ')
                            ->options(['ege' => 'ЕГЭ', 'internal_test' => 'ВИ, проводимое организацией самостоятельно'])->required(),
                        TextInput::make('min_score')->label('Минимальный-балл')->integer()->required()
                    ])->live()->maxItems(10)->collapsed()->addActionLabel('Добавить вступительное испытание')->columns(3)->required()                              ->itemLabel(function (Get $get) {
                        static $count = 0;
                        $maxCount = count($get('exams'));
                        $count = ($count++ <= $maxCount) ? $count : 1;
                        return "Вступительное испытание #" . $count;
                    }),
                    Forms\Components\Repeater::make('contests')->label('Условия поступления')->schema([
                        Forms\Components\Grid::make(2)->schema([
                            Forms\Components\Select::make('form_education')->label('Форма образования')
                                ->options(['och' => 'Очная форма обучения', 'zaoch' => 'Заочная форма обучения', 'och_zaoch' => 'Очно-заочная форма обучения'])->required(),
                            Forms\Components\Select::make('financing_source')->label('Источник финансирования')
                                ->options(['budget' => 'Бюджетное место', 'non_budget' => 'С оплатой обучения'])->required(),
                        ]),
                        Forms\Components\Grid::make(2)->schema([
                            TextInput::make('budget_quantity_position')->label('Количество бюджетных мест')->integer()->required(),
                            TextInput::make('non_budget_quantity_position')->label('Количество платных мест')->integer()->required()
                        ]),
                    ])->live()->maxItems(3)->collapsed()->addActionLabel('Добавить группу')->columns(3)->required()
                        ->itemLabel(function (Get $get) {
                            static $count = 0;
                            $maxCount = count($get('contests'));
                            $count = ($count++ <= $maxCount) ? $count : 1;
                            return "Группа #" . $count;
                        }),

                ]),

            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('admissionCampaign.name'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
