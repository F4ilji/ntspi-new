<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserDetailResource\Pages;
use App\Filament\Resources\UserDetailResource\RelationManagers;
use App\Models\UserDetail;
use Filament\Forms;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Form;
use Filament\Resources\Components\Tab;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserDetailResource extends Resource
{
    protected static ?string $model = UserDetail::class;

    protected static ?string $navigationGroup = 'Settings';


    protected static ?string $pluralLabel = 'Доп. Информация';
    protected static ?string $navigationParentItem = 'Польвазователи';


    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()->schema([
                    Forms\Components\Grid::make(2)->schema([
                        Forms\Components\Select::make('user_id')
                            ->relationship('user', 'email')
                            ->searchable()
                            ->required()
                            ->preload()
                            ->label('Пользователь'),
                        Forms\Components\Toggle::make('is_only_worker')
                            ->inline(false)
                            ->label('Только сотрудник')
                    ]),
                ]),
                Tabs::make('Tabs')
                    ->tabs([
                        Tabs\Tab::make('Основная информация')
                            ->schema([
                                Forms\Components\FileUpload::make('photo')
                                    ->label('Фото')
                                    ->image()
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
                                ])->label('Преподаваемые дисциплины'),
                                Forms\Components\Repeater::make('participationScienceProjects')->schema([
                                    Forms\Components\TextInput::make('item')->label('')->string()->required()
                                ])->label('Преподаваемые дисциплины'),
                                Forms\Components\Repeater::make('publications')->schema([
                                    Forms\Components\TextInput::make('item')->label('')->string()->required()
                                ])->label('Преподаваемые дисциплины'),
                            ]),
                        Tabs\Tab::make('Другое')
                            ->schema([
                                Forms\Components\Textarea::make('other')
                                    ->columnSpanFull(),
                            ]),


                    ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->searchable(),
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
            'index' => Pages\ListUserDetails::route('/'),
            'create' => Pages\CreateUserDetail::route('/create'),
            'edit' => Pages\EditUserDetail::route('/{record}/edit'),
        ];
    }
}
