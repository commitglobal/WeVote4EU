<?php

declare(strict_types=1);

namespace App\Filament\Resources\Posts;

use App\Enums\Country;
use App\Filament\Resources\Posts\Pages\CreatePost;
use App\Filament\Resources\Posts\Pages\EditPost;
use App\Filament\Resources\Posts\Pages\ListPosts;
use App\Models\ElectionDay;
use App\Models\Post;
use Carbon\Carbon;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';

    protected static ?int $navigationSort = 10;

    public static function getNavigationGroup(): ?string
    {
        return __('admin.navigation.newsfeed');
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Section::make()
                    ->columns(2)
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255),

                        Select::make('country')
                            ->options(Country::options())
                            ->enum(Country::class),

                        Select::make('author_id')
                            ->relationship('author', 'name')
                            ->required()
                            ->preload(),

                        Select::make('election_day_id')
                            ->relationship('electionDay', 'date')
                            ->getOptionLabelFromRecordUsing(fn (ElectionDay $record) => $record->date->toDateString())
                            // ->formatStateUsing(fn (Post $record) => dd($record) && $record->date?->toDateString())
                            ->required()
                            ->preload(),

                        DateTimePicker::make('published_at')
                            ->nullable(),

                        RichEditor::make('content')
                            ->required()
                            ->columnSpanFull(),
                    ]),

                \Filament\Schemas\Components\Section::make()
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('media')
                            ->multiple()
                            ->reorderable()
                            ->previewable(false),
                    ]),

                \Filament\Schemas\Components\Section::make()
                    ->schema([
                        Repeater::make('embeds')
                            ->schema([
                                Textarea::make('html'),
                            ]),
                    ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->prefix('#')
                    ->sortable()
                    ->shrink(),

                TextColumn::make('electionDay.date')
                    ->formatStateUsing(fn (?Carbon $state) => $state?->toDateString())
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('country')
                    ->badge()
                    ->formatStateUsing(fn (?Country $state) => $state?->label()),

                TextColumn::make('author.name')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('published_at')
                    ->formatStateUsing(fn (?Carbon $state) => $state?->toDateTimeString())
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                SelectFilter::make('country')
                    ->options(Country::options())
                    ->multiple(),

                SelectFilter::make('author')
                    ->relationship('author', 'name')
                    ->multiple()
                    ->preload(),

                SelectFilter::make('electionDay')
                    ->relationship('electionDay', 'date')
                    ->getOptionLabelFromRecordUsing(fn (ElectionDay $record) => $record->date->toDateString())
                    ->multiple()
                    ->preload(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('id', 'desc');
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
            'index' => ListPosts::route('/'),
            'create' => CreatePost::route('/create'),
            'edit' => EditPost::route('/{record}/edit'),
        ];
    }
}
