<?php

namespace App\Filament\Resources;

use App\Enums\Amenities;
use App\Enums\Cities;
use App\Filament\Resources\ListingResource\Pages;
use App\Filament\Resources\ListingResource\RelationManagers;
use App\Filament\Resources\ListingResource\RelationManagers\ImagesRelationManager;
use App\Models\Listing;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components\ImageEntry;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;

use function Laravel\Prompts\select;

class ListingResource extends Resource
{
    protected static ?string $model = Listing::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
   
        return $form

            ->schema([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Select::make('amenities')
                ->required()
                ->multiple()

                ->options(collect(Amenities::cases())->mapWithKeys(fn($v) => [$v->value => $v->value])),


                Select::make('city')
                ->required()
                ->options(collect(Cities::cases())->mapWithKeys(fn($v) => [$v->value => $v->value])),

                Textarea::make('description')
                    ->required()
                    ->maxLength(65535),

                TextInput::make('price_per_night')
                    ->numeric()
                    ->required(),
                TextInput::make('address')
                    ->required(),

                TextInput::make('number_of_guests')
                    ->numeric()
                    ->required(),

                TextInput::make('number_of_bedrooms')
                    ->numeric()
                    ->required(),

                TextInput::make('number_of_bathrooms')
                    ->numeric()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
      

                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('city')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('price_per_night')
                    ->sortable(),
                ImageColumn::make('images.path')
                ->label('Images')
                ->circular()
                    ->disk('listings')
                    ->stacked()
                    ->limit(3),
                TextColumn::make('created_at')
                    ->date()
                ->label('Created At')
                ->sortable(),

              
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
            ImagesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListListings::route('/'),
            'create' => Pages\CreateListing::route('/create'),
            'edit' => Pages\EditListing::route('/{record}/edit'),
        ];
    }
}
