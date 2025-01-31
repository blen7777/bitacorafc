<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeamResource\Pages;
use App\Models\Team;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TeamResource extends Resource
{
    protected static ?string $model = Team::class;

    protected static ?string $navigationIcon = 'heroicon-o-trophy';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Team Name')
                    ->required()
                    ->maxLength(255),

                TextInput::make('coach')
                    ->label('Coach')
                    ->maxLength(255),

                TextInput::make('phone')
                    ->label('Phone Number')
                    ->tel()
                    ->mask('9999-9999') // Permite escribir números de teléfono en formato salvadoreño
                    ->prefix('+503 ') // Muestra el prefijo de El Salvador fijo
                    ->maxLength(15)
                    ->required(),

                FileUpload::make('logo')
                    ->label('Team Logo')
                    ->image() // Asegura que solo acepte imágenes
                    ->maxSize(2048) // 2MB máximo
                    ->directory('teams/logos') // Carpeta en storage/app/public/
                    ->preserveFilenames() // Mantiene el nombre original
                    ->imagePreviewHeight('150') // Vista previa más clara
                    ->nullable(), // Permite que sea opcional
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('name')
                    ->label('Team Name')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('coach')
                    ->label('Coach')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('phone')
                    ->label('Phone'),
                
                ImageColumn::make('logo')->label('Logo')->circular(), 

                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                // Aquí puedes agregar filtros personalizados si es necesario
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTeams::route('/'),
            'create' => Pages\CreateTeam::route('/create'),
            'edit' => Pages\EditTeam::route('/{record}/edit'),
        ];
    }
}
