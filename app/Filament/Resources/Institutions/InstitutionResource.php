<?php

declare(strict_types=1);

namespace App\Filament\Resources\Institutions;

use App\Filament\Resources\Institutions\Pages\ManageInstitutions;
use App\Models\Institution;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class InstitutionResource extends Resource
{
    protected static ?string $model = Institution::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-building-library';

    protected static ?int $navigationSort = 21;

    public static function getNavigationGroup(): ?string
    {
        return __('admin.navigation.partners');
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Checkbox::make('enabled')
                    ->label('Enabled')
                    ->columnSpanFull(),

                TextInput::make('name')
                    ->required(),

                TextInput::make('url')
                    ->url(),

                SpatieMediaLibraryFileUpload::make('logo')
                    ->collection('logo')
                    ->image()
                    ->columnSpanFull()
                    ->required(),
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

                SpatieMediaLibraryImageColumn::make('logo')
                    ->collection('logo')
                    ->conversion('thumb')
                    ->toggleable()
                    ->shrink(),

                TextColumn::make('name')
                    ->sortable(),

                TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->toggleable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
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
            'index' => ManageInstitutions::route('/'),
        ];
    }
}
