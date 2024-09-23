<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GenerationResource\Pages;
use App\Filament\Resources\GenerationResource\RelationManagers;
use App\Models\Generation;
use App\Models\Make;
use App\Models\MakeModel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\HtmlString;

class GenerationResource extends Resource
{
    protected static ?string $model = Generation::class;

    protected static ?int $navigationSort = 3;

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
                        Forms\Components\TextInput::make('year_from')
                            ->label('Year From')
                            ->type('number')
                            ->required(),

                        Forms\Components\TextInput::make('year_to')
                            ->label('Year To')
                            ->type('number'),

                        Forms\Components\Select::make('make_model_id')
                            ->label('Make Model')
                            ->relationship('makeModel', 'name', modifyQueryUsing: fn (Builder $query) => $query->orderBy('sort'))
                            ->getOptionLabelFromRecordUsing(fn (MakeModel $record) => "{$record->make->name}: {$record->name}")
                            ->preload()
                            ->searchable()
                            ->required(),
                    ])
                    ->columns(3)
                    ->columnSpan(2),

                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\SpatieMediaLibraryFileUpload::make('image')
                            ->maxFiles(1)
                            ->placeholder(new HtmlString('Drag the generation\'s image here or <span class="filepond--label-action">browse</span>')),
                    ])
                    ->columnSpan(1),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('makeModel.make.name')
                    ->label('Make')
                    ->sortable(),


                Tables\Columns\TextColumn::make('year_from')
                    ->label('Year From')
                    ->sortable()
                    ->default('&mdash;'),

                Tables\Columns\TextColumn::make('year_to')
                    ->label('Year To')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\Filter::make('make_make_model')
                    ->form([
                       Forms\Components\Select::make('make_id')
                            ->label('Make')
                            ->relationship('makeModel.make', 'name')
                            ->preload()
                            ->searchable()
                            ->live()
                            ->afterStateUpdated(function (?string $state, ?string $old, Forms\Set $set): void {
                                $set('make_model_id', null);
                            }),

                        Forms\Components\Select::make('make_model_id')
                            ->label('Model')
                            ->relationship('makeModel', 'name', modifyQueryUsing: function (Builder $query, Forms\Get $get): void {
                                $query->orderBy('sort');

                                if(filled($get('make_id'))) {
                                    $query->where('make_id', $get('make_id'));
                                }
                            })
                            ->disabled(fn (Forms\Get $get): bool => ! filled($get('make_id')))
                            ->preload()
                            ->searchable(),
                    ])
                    ->query(function(Builder $query, array $data): Builder {
                        if(filled($data['make_model_id'])) {
                            $query->where('make_model_id', $data['make_model_id']);
                        }

                        if(filled($data['make_id'])) {
                            $query->whereHas('makeModel', function (Builder $query) use ($data) {
                                $query->where('make_id', $data['make_id']);
                            });
                        }

                        return $query;
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];

                        if($data['make_id'] ?? null) {
                            $indicators[] = Tables\Filters\Indicator::make('Make: ' . Make::find($data['make_id'])->name)
                                ->removable(false);
                        }

                        if($data['make_model_id'] ?? null) {
                            $indicators[] = Tables\Filters\Indicator::make('Model: ' . MakeModel::find($data['make_model_id'])->name)
                                ->removable(false);
                        }

                        return $indicators;
                    })
                    ->columns(2)
                    ->columnSpan(2),
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
            ->defaultGroup('makeModel.name');
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\EnginesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGenerations::route('/'),
            'create' => Pages\CreateGeneration::route('/create'),
            'edit' => Pages\EditGeneration::route('/{record}/edit'),
        ];
    }
}
