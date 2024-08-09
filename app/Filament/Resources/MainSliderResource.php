<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MainSliderResource\Pages;
use App\Filament\Resources\MainSliderResource\RelationManagers;
use App\Models\Event;
use App\Models\MainSlider;
use App\Models\Page;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class MainSliderResource extends Resource
{
    protected static ?string $model = MainSlider::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Выбор схемы')->schema([
                    Forms\Components\Grid::make()->schema([
                        Forms\Components\Select::make('model_select')->name('')
                            ->options([
                                'Post' => 'Новость',
                                'Page' => 'Страница',
                                'Event' => 'Мероприятие',
                                'Custom' => 'Кастомная ссылка',
                            ])
                            ->afterStateUpdated(function (string $operation, string|null $state, Forms\Set $set, Forms\Get $get) {
                                if ($get('model_select') === 'Custom') {
                                    $set('model', null);
                                    $set('title', null);
                                    $set('content', null);
                                    $set('link', null);
                                };
                            })->live(onBlur: true),

                        Forms\Components\Select::make('model')->name('')
                            ->live(onBlur: true)
                            ->searchable()
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (string $operation, string|null $state, Forms\Set $set, Forms\Get $get) {
                                if ($get('model_select') === 'Post') {
                                    $post = Post::find($state);
                                    $set('title', $post->title);
                                    $relativeUrl = parse_url(route('client.post.show', $post->slug), PHP_URL_PATH);
                                    $set('link', $relativeUrl);
                                };
                                if ($get('model_select') === 'Page') {
                                    $page = Page::find($state);
                                    $set('title', $page->title);
                                    $set('link', $page->path);
                                };
                                if ($get('model_select') === 'Event') {
                                    $event = Event::find($state);
                                    $set('title', $event->title);
                                    $relativeUrl = parse_url(route('client.event.show', $event->slug), PHP_URL_PATH);
                                    $set('link', $relativeUrl);
                                };

                            })
                            ->options(function (Forms\Get $get) {
                                if ($get('model_select') === 'Post') {
                                    return Post::where('status', '=', 'published')->pluck('title', 'id');
                                };
                                if ($get('model_select') === 'Page') {
                                    return Page::where('title', '!=', null)->pluck('title', 'id');
                                };
                                if ($get('model_select') === 'Event') {
                                    return Event::all()->pluck('title', 'id');
                                };
                                if ($get('model_select') === 'Custom') {
                                    return [];
                                };
                            }),
                    ]),
                ]),
                Forms\Components\Section::make('Слайдер')->schema([
                    Forms\Components\TextInput::make('title')->required(),
                    Forms\Components\Textarea::make('content'),
                    FileUpload::make('image')
                        ->label('Изображение')
                        ->image()
                        ->disk('public')
                        ->directory('images')
                        ->imageEditor(),
                    Forms\Components\Grid::make(2)->schema([
                        Forms\Components\TextInput::make('link')->required(),
                        Forms\Components\TextInput::make('link_text')->default('Читать')->required(),
                    ]),
                    ColorPicker::make('color_theme')->default('#ffffff')->required(),

                    Toggle::make('is_active')->default(true)->label('Активный слайдер')->inline(false),
                ]),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->reorderable('sort')
            ->defaultSort('sort')
            ->columns([
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\ToggleColumn::make('is_active')
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
            'index' => Pages\ListMainSliders::route('/'),
            'create' => Pages\CreateMainSlider::route('/create'),
            'edit' => Pages\EditMainSlider::route('/{record}/edit'),
        ];
    }
}
