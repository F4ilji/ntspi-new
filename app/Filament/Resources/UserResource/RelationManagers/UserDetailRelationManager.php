<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserDetailRelationManager extends RelationManager
{
    protected static string $relationship = 'userDetail';

    protected static ?string $inverseRelationship = 'user';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()->schema([
                    Forms\Components\Toggle::make('is_only_worker')
                        ->inline(false)
                        ->label('Только сотрудник')
                ]),
                Tabs::make('Tabs')
                    ->tabs([
                        Tabs\Tab::make('Основная информация')
                            ->schema([
                                Forms\Components\FileUpload::make('photo')
                                    ->label('Фото')
                                    ->image()
                                    ->disk('public')
                                    ->directory('images')
                                    ->imageEditor()
                                    ->required(),
                                Forms\Components\Grid::make()->schema([
                                    Forms\Components\TextInput::make('contactEmail')
                                        ->label('Контактный Email')
                                        ->maxLength(255),
                                    Forms\Components\TextInput::make('contactPhone')
                                        ->label('Контактный телефон')
                                        ->maxLength(255),
                                ]),
                            ]),
                        Tabs\Tab::make('Образование')
                            ->schema([
                                Forms\Components\Grid::make()->schema([
                                    Forms\Components\TextInput::make('academicTitle')
                                        ->label('Ученая степень')
                                        ->maxLength(255),
                                    Forms\Components\TextInput::make('AcademicDegree')
                                        ->label('Ученое звание')
                                        ->maxLength(255),
                                ]),
                                Forms\Components\TextInput::make('education')
                                    ->label('Образование')
                                    ->maxLength(255),
                                Forms\Components\Repeater::make('professionalRetraining')->schema([
                                    Forms\Components\TextInput::make('item')->label('')->string()->required()
                                ])->label('Профессиональная переподготовка'),
                                Forms\Components\Repeater::make('professionalDevelopment')
                                    ->schema([
                                        Forms\Components\TextInput::make('item')->label('')->string()->required()
                                    ])->label('Повышение квалификации'),
                                Forms\Components\Repeater::make('awards')->schema([
                                    Forms\Components\TextInput::make('item')->label('')->string()->required()
                                ])->label('Награды'),
                            ]),
                        Tabs\Tab::make('Преподавание')
                            ->schema([
                                Forms\Components\TextInput::make('workExperience')
                                    ->label('Стаж работы')
                                    ->numeric(),
                                Forms\Components\Repeater::make('professDisciplines')->schema([
                                    Forms\Components\TextInput::make('item')->label('')->string()->required()
                                ])->label('Преподаваемые дисциплины'),
                            ]),
                        Tabs\Tab::make('Научная деятельность')
                            ->schema([
                                Forms\Components\Repeater::make('attendedConferences')->schema([
                                    Forms\Components\TextInput::make('item')->label('')->string()->required()
                                ])->label('Участие в конференциях'),
                                Forms\Components\Repeater::make('participationScienceProjects')->schema([
                                    Forms\Components\TextInput::make('item')->label('')->string()->required()
                                ])->label('Участие в научных проектах'),
                                Forms\Components\Repeater::make('publications')->schema([
                                    Forms\Components\TextInput::make('item')->label('')->string()->required()
                                ])->label('Публикации'),
                            ]),
                        Tabs\Tab::make('Другое')
                            ->schema([
                                Forms\Components\Textarea::make('other')
                                    ->columnSpanFull(),
                            ]),


                    ])->columnSpanFull(),
            ]);
    }


    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('user_id')
            ->columns([
                Tables\Columns\TextColumn::make('user_id'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->visible(!$this->ownerRecord->userDetail()->exists()),
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
