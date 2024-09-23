<?php

namespace App\Filament\Resources\GenerationResource\RelationManagers;

use App\Enums\FuelType;
use App\Models\Engine;
use App\Models\Generation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EnginesRelationManager extends RelationManager
{
    protected static string $relationship = 'engines';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Select::make('fuel_type')
                    ->options(FuelType::class)
                    ->required(),

                Forms\Components\Toggle::make('visible')
                    ->label('Visible in catalog')
                    ->default(true),

                Forms\Components\Repeater::make('tunes')
                    ->label('Tunes')
                    ->relationship()
                    ->itemLabel(fn (array $state): ?string => $state['name'] ?? null)
                    ->orderColumn('sort')
                    ->collapsible(true)
                    ->collapsed(true)
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->columnSpan(2)
                            ->live()
                            ->dataList([
                                'Stage 1',
                                'Stage 2',
                                'Stage 3',
                                'Stage 4',
                            ]),

                        Forms\Components\TextInput::make('original_hp')->nullable(),
                        Forms\Components\TextInput::make('tuned_hp')->nullable(),
                        Forms\Components\TextInput::make('original_nm')->nullable(),
                        Forms\Components\TextInput::make('tuned_nm')->nullable(),
                        Forms\Components\TextInput::make('ecu')->nullable(),
                        Forms\Components\TextInput::make('ecu_category')->nullable(),
                        Forms\Components\TextInput::make('cylinder_capacity')->nullable(),
                        Forms\Components\TextInput::make('compression_ratio')->nullable(),
                        Forms\Components\TextInput::make('bore_x_stroke')->nullable(),
                        Forms\Components\TextInput::make('engine_number')->nullable(),
                        Forms\Components\TextInput::make('engine_ecu')->nullable(),
                        Forms\Components\TextInput::make('gearbox')->nullable(),
                        Forms\Components\TextInput::make('read_methods')->nullable(),

                        Forms\Components\CheckboxList::make('extraOptions')
                            ->relationship('extraOptions', 'name')
                            ->columnSpan(2)
                            ->columns(2),
                    ])
                    ->columns(2)
                    ->columnSpan(3),
            ])
            ->columns(3);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name'),

                Tables\Columns\TextColumn::make('fuel_type')
                    ->grow(),

                Tables\Columns\CheckboxColumn::make('visible')
                    ->label('Visible'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->reorderable('sort')
            ->defaultSort('sort');
    }
}
