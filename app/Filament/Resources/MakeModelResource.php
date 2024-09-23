<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MakeModelResource\Pages;
use App\Filament\Resources\MakeModelResource\RelationManagers;
use App\Models\MakeModel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MakeModelResource extends Resource
{
    protected static ?string $model = MakeModel::class;

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationGroup = 'Master Data';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Name')
                            ->required()
                            ->maxLength('255'),

                        Forms\Components\Select::make('make_id')
                            ->label('Make')
                            ->relationship('make', 'name')
                            ->preload()
                            ->searchable()
                            ->required(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('make_id')
                    ->label('Make')
                    ->relationship('make', 'name'),
            ], layout: Tables\Enums\FiltersLayout::AboveContent)
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('sort')
            ->defaultGroup('make.name');
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
            'index' => Pages\ListMakeModels::route('/'),
            'create' => Pages\CreateMakeModel::route('/create'),
            'edit' => Pages\EditMakeModel::route('/{record}/edit'),
        ];
    }
}
