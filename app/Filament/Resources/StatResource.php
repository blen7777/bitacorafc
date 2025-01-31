<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StatResource\Pages;
use App\Models\Stat;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class StatResource extends Resource
{
    protected static ?string $model = Stat::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('player_id')
                    ->relationship('player', 'name')
                    ->label('Jugador')
                    ->required(),

                Select::make('match_id')
                    ->relationship('match', 'id')
                    ->getOptionLabelFromRecordUsing(fn ($record) => $record->homeTeam->name . ' vs ' . $record->awayTeam->name)
                    ->label('Partido')
                    ->required(),

                TextInput::make('goals')
                    ->label('Goles Anotados')
                    ->numeric()
                    ->minValue(0)
                    ->default(0)
                    ->required(),

                TextInput::make('assists')
                    ->label('Asistencias')
                    ->numeric()
                    ->default(0)
                    ->minValue(0)
                    ->required(),

                TextInput::make('yellow_cards')
                    ->label('Tarjetas Amarillas')
                    ->numeric()
                    ->default(0)
                    ->minValue(0)
                    ->required(),

                TextInput::make('red_cards')
                    ->label('Tarjetas Rojas')
                    ->numeric()
                    ->default(0)
                    ->minValue(0)
                    ->required(),

                TextInput::make('minutes_played')
                    ->label('Minutos Jugados')
                    ->numeric()
                    ->default(0)
                    ->minValue(0)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('player.name')
                    ->label('Jugador')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('match.homeTeam.name')
                    ->label('Equipo Local')
                    ->sortable(),

                TextColumn::make('match.awayTeam.name')
                    ->label('Equipo Visitante')
                    ->sortable(),

                TextColumn::make('goals')
                    ->label('Goles')
                    ->sortable(),

                TextColumn::make('assists')
                    ->label('Asistencias')
                    ->sortable(),

                TextColumn::make('yellow_cards')
                    ->label('Tarjetas Amarillas')
                    ->sortable(),

                TextColumn::make('red_cards')
                    ->label('Tarjetas Rojas')
                    ->sortable(),
            ])
            ->filters([
                //
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStats::route('/'),
            'create' => Pages\CreateStat::route('/create'),
            'edit' => Pages\EditStat::route('/{record}/edit'),
        ];
    }
}
