<?php

declare(strict_types=1);

namespace App\Filament\Resources\ElectionDays;

use App\Filament\Resources\ElectionDays\Pages\ManageElectionDays;
use App\Models\ElectionDay;
use Carbon\Carbon;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ElectionDayResource extends Resource
{
    protected static ?string $model = ElectionDay::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?int $navigationSort = 12;

    public static function getNavigationGroup(): ?string
    {
        return __('admin.navigation.newsfeed');
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                DatePicker::make('date')
                    ->time(false)
                    ->unique(ignoreRecord:true)
                    ->columnSpanFull(),
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

                TextColumn::make('date')
                    ->sortable()
                    ->formatStateUsing(fn (Carbon $state) => $state->toDateString()),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('date', 'desc');
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
            'index' => ManageElectionDays::route('/'),
        ];
    }
}
