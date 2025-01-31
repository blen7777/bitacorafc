<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MatchesResource\Pages;
use App\Models\Matches;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TimePicker;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ImageColumn;

class MatchesResource extends Resource
{
    protected static ?string $model = Matches::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    public static function getSlug(): string
    {
        return 'matches'; 
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('home_team_id')
                    ->relationship('homeTeam', 'name')
                    ->required()
                    ->label('Equipo Local'),

                Select::make('away_team_id')
                    ->relationship('awayTeam', 'name')
                    ->required()
                    ->label('Equipo Visitante'),

                DatePicker::make('match_date')
                    ->required()
                    ->label('Fecha del Partido'),

                TimePicker::make('match_time')
                    ->required()
                    ->label('Hora del Partido'),

                TextInput::make('location')
                    ->required()
                    ->label('Estadio')
                    ->maxLength(255),
                
                Select::make('status')
                    ->options([
                        'scheduled' => 'Programado',
                        'in_progress' => 'En curso',
                        'completed' => 'Finalizado',
                        'canceled' => 'Cancelado',
                    ])
                    ->required()
                    ->label('Estado del Partido'),

                TextInput::make('score_home')
                    ->numeric()
                    ->label('Goles Equipo Local'),

                TextInput::make('score_away')
                    ->numeric()
                    ->label('Goles Equipo Visitante'),
                
                TextInput::make('guarantee')
                    ->numeric()
                    ->label('Fianza del partido'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('homeTeam.name')
                    ->label('Equipo Local')
                    ->sortable()
                    ->searchable(),

                ImageColumn::make('homeTeam.logo')
                    ->label('Logo Local')
                    ->circular(),

                TextColumn::make('awayTeam.name')
                    ->label('Equipo Visitante')
                    ->sortable()
                    ->searchable(),

                ImageColumn::make('awayTeam.logo')
                    ->label('Logo Visitante')
                    ->circular(),

                TextColumn::make('match_date')
                    ->label('Fecha del Partido')
                    ->date()
                    ->sortable(),

                BadgeColumn::make('status')
                    ->label('Estado')
                    ->sortable()
                    ->colors([
                        'warning' => 'Pendiente',
                        'info' => 'En curso',
                        'success' => 'Finalizado',
                    ]),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMatches::route('/'),
            'create' => Pages\CreateMatches::route('/create'),
            'edit' => Pages\EditMatches::route('/{record}/edit'),
        ];
    }
}
