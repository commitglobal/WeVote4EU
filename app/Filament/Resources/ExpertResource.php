<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Enums\Country;
use App\Enums\ExpertLink;
use App\Filament\Resources\ExpertResource\Pages;
use App\Models\Expert;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class ExpertResource extends Resource
{
    protected static ?string $model = Expert::class;

    protected static ?string $navigationIcon = 'heroicon-o-identification';

    protected static ?int $navigationSort = 22;

    public static function getNavigationGroup(): ?string
    {
        return __('admin.navigation.partners');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                Split::make([
                    SpatieMediaLibraryFileUpload::make('avatar')
                        ->collection('avatar')
                        ->avatar()
                        ->grow(false),

                    Grid::make()
                        ->schema([
                            TextInput::make('name')
                                ->required()
                                ->maxLength(255)
                                ->columnSpanFull(),

                            TextInput::make('title')
                                ->nullable()
                                ->maxLength(255),

                            Select::make('country')
                                ->options(Country::options())
                                ->enum(Country::class),

                            Checkbox::make('enabled')
                                ->label('Enabled')
                                ->columnSpanFull(),
                        ]),
                ]),

                Repeater::make('links')
                    ->columns(4)
                    ->schema([
                        Select::make('type')
                            ->options(ExpertLink::options())
                            ->enum(ExpertLink::class)
                            ->required(),

                        TextInput::make('url')
                            ->url()
                            ->required()
                            ->columnSpan(3),
                    ])
                    ->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order')
                    ->alignRight()
                    ->shrink(),

                ToggleColumn::make('enabled')
                    ->label('Enabled')
                    ->shrink(),

                SpatieMediaLibraryImageColumn::make('avatar')
                    ->collection('avatar')
                    ->conversion('thumb')
                    ->toggleable()
                    ->shrink(),

                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('title')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('country')
                    ->badge()
                    ->formatStateUsing(fn (?Country $state) => $state?->label())
                    ->toggleable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->defaultSort('order', 'asc')
            ->reorderable('order');
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
            'index' => Pages\ManageExperts::route('/'),
        ];
    }
}
