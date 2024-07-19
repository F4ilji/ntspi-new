<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ScheduleResource\Pages;
use App\Filament\Resources\ScheduleResource\RelationManagers;
use App\Models\Category;
use App\Models\EducationalGroup;
use App\Models\Schedule;
use Closure;
use Filament\Forms;
use Filament\Forms\Components\Builder;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\Livewire;

class ScheduleResource extends Resource
{
    protected static ?string $model = Schedule::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $pluralLabel = 'Расписание';

    protected static ?string $navigationParentItem = 'Группы';


    protected static array $weekDays = ['Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота', 'Воскресенье'];
    protected static array $typeWeek = ['Четная', 'Нечетная'];





    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Forms\Components\Grid::make(2)->schema([
                            Select::make('educational_group_id')->options(EducationalGroup::all()->pluck('title', 'id'))->label('Выбрать группу')
                                ->required(),
                            TextInput::make('title')->label('Заголовок')->required(),

                            Select::make('type')->options([
                                'schedule' => 'Обычное расписание',
                                'interval' => 'Временное расписание',
                                'exam' => 'Промежуточная аттестация',
                            ])->label('Тип расписания')->required()->live(),
                            Forms\Components\Toggle::make('is_zaoch')->label('Очная|Заочная')->inline(false),

                        ]),
                        Forms\Components\Repeater::make('days')->label('')->schema([
                            Forms\Components\Repeater::make('form')->label('')->schema([
                                Forms\Components\Repeater::make('weeks')->label('')->schema([
                                    Forms\Components\Repeater::make('lesson_info')->label('')->schema([
                                        TextInput::make('title')->label('Название-пары'),
                                        TextInput::make('teacher')->label('Преподаватель'),
                                        TextInput::make('studyRoom')->label('Кабинет')
                                    ])->live()->maxItems(2)->collapsed()->addActionLabel('Добавить подгруппу')->columns(3)
                                    ->itemLabel(function (Get $get, $state) {
                                        static $count = 1;
                                        if (count($get('lesson_info')) === 1) {
                                            return "Общая группа";
                                        } else {
                                            $nmb = $count++ % 2 == 0 ? 2 : 1;
                                            return "Подгруппа " . $nmb;                                        }
                                    }),
                                ])->maxItems(2)->addActionLabel('Добавить четную/нечетную неделю')
                                    ->itemLabel(function (Get $get) {
                                    static $position = 0;
                                    if (count($get('weeks')) === 1) {
                                        return "Общая неделя";
                                    } else {
                                        $nmb = $position++ % 2 == 0 ? 0 : 1;
                                        return self::$typeWeek[$nmb] . " неделя";
                                    }
                                })
                                ->collapsed()
                            ])
                                ->maxItems(5)
                                ->itemLabel(function (Get $get) {
                                    static $count = 0;
                                    $maxCount = count($get('form'));
                                    $count = ($count++ <= $maxCount) ? $count : 1;
                                    return "Пара #" . $count;
                                })
                                ->addActionLabel('Добавить пару'),
                        ])->maxItems(6)->minItems(1)->itemLabel(function ($state) {
                            static $position = 0;
                            return self::$weekDays[$position++];
                        })->addActionLabel('Добавить день недели')->collapsed()->defaultItems(6)->hidden(function (callable $get) {
                            if ($get('type') === 'schedule' || $get('type') === 'interval') {
                                return false;
                            } else {
                                return true;
                            }
                        }),
            ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('type'),
                IconColumn::make('is_zaoch')
                    ->boolean(),
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
            'index' => Pages\ListSchedules::route('/'),
            'create' => Pages\CreateSchedule::route('/create'),
            'edit' => Pages\EditSchedule::route('/{record}/edit'),
        ];
    }
}
