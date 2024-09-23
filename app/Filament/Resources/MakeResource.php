<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MakeResource\Pages;
use App\Filament\Resources\MakeResource\RelationManagers;
use App\Models\Make;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;

class MakeResource extends Resource
{
    protected static ?string $model = Make::class;

    protected static ?int $navigationSort = 1;

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
                            ->maxLength('255')
                            ->live(onBlur: 250)
                            ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                                if($operation !== 'create') {
                                    return;
                                }

                                $set('slug', Str::slug($state));
                            }),

                        Forms\Components\TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->disabled()
                            ->dehydrated()
                            ->maxLength('255')
                            ->unique('makes', 'slug', ignoreRecord: true),
                    ])
                    ->columnSpan(2)
                    ->columns(2),

                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\SpatieMediaLibraryFileUpload::make('logo')
                            ->label('Logo')
                            ->placeholder(new HtmlString('Drag the make\'s logo here or <span class="filepond--label-action">browse</span>'))
                            ->maxFiles(1),
                    ])
                    ->columnSpan(1),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('logo')
                    ->label('Logo'),

                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable()
                    ->grow(),
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
            RelationManagers\MakeModelsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMakes::route('/'),
            'create' => Pages\CreateMake::route('/create'),
            'edit' => Pages\EditMake::route('/{record}/edit'),
        ];
    }
}
