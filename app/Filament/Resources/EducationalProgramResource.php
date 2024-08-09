<?php

namespace App\Filament\Resources;

use App\Enums\EducationalProgramStatus;
use App\Enums\LevelEducational;
use App\Filament\Resources\EducationalProgramResource\Pages;
use App\Filament\Resources\EducationalProgramResource\RelationManagers;
use App\Filament\Resources\EducationalProgramResource\RelationManagers\AdmissionPlansRelationManager;
use App\Models\Category;
use App\Models\EducationalProgram;
use Filament\Forms;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class EducationalProgramResource extends Resource
{
    protected static ?string $model = EducationalProgram::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $pluralLabel = 'Образовательные программы';

    protected static ?string $navigationParentItem = 'Приемная-компания';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        TextInput::make('name')->label('Название')->required(),
                        Section::make('О программе')->schema([
                            Builder::make('about_program')->label('')->blocks([
                                Builder\Block::make('heading')->label('Заголовок')
                                    ->schema([
                                        TextInput::make('id')->hidden()->integer()->default(rand(2335235,324634264263426)),
                                        TextInput::make('content')
                                            ->label('')
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(function (string $operation, string $state, Forms\Set $set, $get) {
                                            }),
                                    ]),
                                Builder\Block::make('paragraph')
                                    ->schema([
                                        TinyEditor::make('content')
                                            ->label('Текст')
                                            ->profile('test')
                                            ->required()
                                    ]),
                                Builder\Block::make('image')
                                    ->schema([
                                        FileUpload::make('url')
                                            ->label('Изображение(-я)')
                                            ->image()
                                            ->multiple()
                                            ->reorderable()
                                            ->maxFiles(5)
                                            ->disk('public')
                                            ->directory('images')
                                            ->imageEditor()
                                            ->required(),
                                        TextInput::make('alt')
                                            ->label('Описание')
                                            ->placeholder('Необязяательно')
                                    ])->label('Изображение(-я)'),
                                Builder\Block::make('video')
                                    ->schema([
                                        Hidden::make('mime'),

                                        TextInput::make('title')
                                            ->required()
                                            ->maxLength(255)
                                            ->autofocus(),

                                        FileUpload::make('path')
                                            ->required()
                                            ->acceptedFileTypes(['video/mp4','video/ogg','video/webm'])
                                            ->maxSize(512000)
                                            ->disk('videos')
                                            ->visibility('public')
                                            ->afterStateUpdated(fn (callable $set, $state) => $set('mime', $state?->getMimeType())),
                                    ]),
                                Builder\Block::make('files')
                                    ->schema([
                                        TextInput::make('title')
                                            ->required()
                                            ->maxLength(255)
                                            ->autofocus(),
                                        FileUpload::make('path')
                                            ->required()
                                            ->acceptedFileTypes([
                                                'application/pdf',
                                                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                                                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                                                'application/vnd.openxmlformats-officedocument.presentationml.presentation',
                                                'application/zip'
                                            ])
                                            ->maxSize(512000)
                                            ->disk('public')
                                            ->directory('files')
                                            ->downloadable()
                                            ->visibility('public')
                                    ])
                            ])
                                ->collapsed()
                                ->blockNumbers(false)
                                ->collapsible()
                                ->addActionLabel('Добавить новый блок'),

                        ]),
                        Section::make('Особенности программы')->schema([
                            Builder::make('program_features')->label('')->blocks([
                                Builder\Block::make('heading')->label('Заголовок')
                                    ->schema([
                                        TextInput::make('id')->hidden()->integer()->default(rand(2335235,324634264263426)),
                                        TextInput::make('content')
                                            ->label('')
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(function (string $operation, string $state, Forms\Set $set, $get) {
                                            }),
                                    ]),
                                Builder\Block::make('paragraph')
                                    ->schema([
                                        TinyEditor::make('content')
                                            ->label('Текст')
                                            ->profile('test')
                                            ->required()
                                    ]),
                                Builder\Block::make('image')
                                    ->schema([
                                        FileUpload::make('url')
                                            ->label('Изображение(-я)')
                                            ->image()
                                            ->multiple()
                                            ->reorderable()
                                            ->maxFiles(5)
                                            ->disk('public')
                                            ->directory('images')
                                            ->imageEditor()
                                            ->required(),
                                        TextInput::make('alt')
                                            ->label('Описание')
                                            ->placeholder('Необязяательно')
                                    ])->label('Изображение(-я)'),
                                Builder\Block::make('video')
                                    ->schema([
                                        Hidden::make('mime'),

                                        TextInput::make('title')
                                            ->required()
                                            ->maxLength(255)
                                            ->autofocus(),

                                        FileUpload::make('path')
                                            ->required()
                                            ->acceptedFileTypes(['video/mp4','video/ogg','video/webm'])
                                            ->maxSize(512000)
                                            ->disk('videos')
                                            ->visibility('public')
                                            ->afterStateUpdated(fn (callable $set, $state) => $set('mime', $state?->getMimeType())),
                                    ]),
                                Builder\Block::make('files')
                                    ->schema([
                                        TextInput::make('title')
                                            ->required()
                                            ->maxLength(255)
                                            ->autofocus(),
                                        FileUpload::make('path')
                                            ->required()
                                            ->acceptedFileTypes([
                                                'application/pdf',
                                                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                                                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                                                'application/vnd.openxmlformats-officedocument.presentationml.presentation',
                                                'application/zip'
                                            ])
                                            ->maxSize(512000)
                                            ->disk('public')
                                            ->directory('files')
                                            ->downloadable()
                                            ->visibility('public')
                                    ])
                            ])
                                ->collapsed()
                                ->blockNumbers(false)
                                ->collapsible()
                                ->addActionLabel('Добавить новый блок'),

                        ]),

                        Select::make('lvl_edu')->options(LevelEducational::class)->label('Уровень образования')->required(),
                        Select::make('status')
                            ->options(EducationalProgramStatus::class)
                            ->label('Статус программы')->required(),
                        TextInput::make('lang_stud')->label('На каком языке ведется образование')->required(),

                    ])
            ]);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('code_napr'),
                Tables\Columns\TextColumn::make('directionStudy.lvl_edu')->limit(30),
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
            AdmissionPlansRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEducationalPrograms::route('/'),
            'create' => Pages\CreateEducationalProgram::route('/create'),
            'edit' => Pages\EditEducationalProgram::route('/{record}/edit'),
        ];
    }
}
