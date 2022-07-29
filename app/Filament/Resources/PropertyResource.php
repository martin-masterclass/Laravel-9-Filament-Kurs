<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PropertyResource\Pages;
use App\Filament\Resources\PropertyResource\RelationManagers;
use App\Models\Property;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Tabs;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PropertyResource extends Resource
{
    protected static ?string $model = Property::class;

    protected static ?string $modelLabel = 'Immobilie';
    protected static ?string $pluralModelLabel = 'Immobilien';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form->schema(
            Tabs::make('Heading')
                ->tabs([
                    Tabs\Tab::make('Hauptdaten')
                        ->columns(12)
                        ->schema([
                            Forms\Components\TextInput::make('title')
                                ->columnSpan(12)
                                ->required()
                                ->maxLength(255),
                            Forms\Components\RichEditor::make('description')
                                ->columnSpan(12)
                                ->required()
                                ->maxLength(65535),
                            Forms\Components\TextInput::make('country')
                                ->columnSpan(6)
                                ->required()
                                ->maxLength(255),
                            Forms\Components\TextInput::make('city')
                                ->columnSpan(6)
                                ->required()
                                ->maxLength(255),
                            Forms\Components\TextInput::make('address')
                                ->columnSpan(6)
                                ->required()
                                ->maxLength(255),
                            Forms\Components\TextInput::make('price')
                                ->columnSpan(3)
                                ->required(),
                            Forms\Components\TextInput::make('sqm')
                                ->columnSpan(3)
                                ->required()->numeric(),
                            Forms\Components\TextInput::make('bedrooms')
                                ->columnSpan(2)
                                ->required()->numeric(),
                            Forms\Components\TextInput::make('bathrooms')
                                ->columnSpan(2)
                                ->required()->numeric(),
                            Forms\Components\TextInput::make('garages')
                                ->columnSpan(2)
                                ->required()->numeric(),
                            Forms\Components\Toggle::make('slider')
                                ->columnSpan(2)
                                ->required(),
                            Forms\Components\Toggle::make('visible')
                                ->columnSpan(4)
                                ->required(),
                            Forms\Components\DatePicker::make('start_date')
                                ->columnSpan(2)
                                ->required(),
                            Forms\Components\DatePicker::make('end_date')
                                ->columnSpan(2)
                                ->required(),
                        ]),
                    Tabs\Tab::make('Bilder')
                        ->schema([
                            SpatieMediaLibraryFileUpload::make('Sliderbild')
                                ->image()
                                ->collection('slider')
                                ->columnSpan(6),
                            SpatieMediaLibraryFileUpload::make('Hauptbilder (Bitte speichern!)')
                                ->image()
                                ->multiple()
                                ->enableReordering()
                                ->collection('hauptbilder')
                                ->columnSpan(6),
                        ])->columns(12),
                ])
        );




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
