<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PropertyResource\Pages;
use App\Filament\Resources\PropertyResource\RelationManagers;
use App\Models\Property;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PropertyResource extends Resource
{
    protected static ?string $model = Property::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\RichEditor::make('description')
                    ->required()
                    ->maxLength(65535),
                Forms\Components\TextInput::make('country')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('city')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('address')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('price')
                    ->required(),
                Forms\Components\TextInput::make('sqm')
                    ->required()->numeric(),
                Forms\Components\TextInput::make('bedrooms')
                    ->required()->numeric(),
                Forms\Components\TextInput::make('bathrooms')
                    ->required()->numeric(),
                Forms\Components\TextInput::make('garages')
                    ->required()->numeric(),
                Forms\Components\Toggle::make('slider')
                    ->required(),
                Forms\Components\Toggle::make('visible')
                    ->required(),
                Forms\Components\DatePicker::make('start_date')
                    ->required(),
                Forms\Components\DatePicker::make('end_date')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Titel')
                    ->sortable()->searchable()
                    ->limit(10),
                Tables\Columns\TextColumn::make('country')
                    ->label('Land')
                    ->sortable()->searchable()
                    ->limit(15),
                Tables\Columns\TextColumn::make('price')
                    ->label('Preis')
                    ->sortable()
                    ->alignRight(),
                Tables\Columns\TextColumn::make('sqm')
                    ->label('QM')
                    ->sortable()
                    ->alignRight(),
                Tables\Columns\TextColumn::make('bedrooms')
                    ->label('Schlafz.')
                    ->sortable()
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('bathrooms')
                    ->label('Bäder')
                    ->sortable()
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('garages')
                    ->label('Garage')
                    ->sortable()
                    ->alignCenter(),
                Tables\Columns\BooleanColumn::make('slider'),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
                Tables\Actions\ForceDeleteBulkAction::make(),
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
            'index' => Pages\ListProperties::route('/'),
            'create' => Pages\CreateProperty::route('/create'),
            'edit' => Pages\EditProperty::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
