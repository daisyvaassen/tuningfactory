<?php

namespace App\Livewire;

use Filament\Facades\Filament;
use Filament\Notifications\Notification;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\Sanctum;
use Livewire\Component;
use Filament\Tables;
use Filament\Actions;
use Filament\Forms;

class SanctumTokens extends Component implements Tables\Contracts\HasTable, Actions\Contracts\HasActions, Forms\Contracts\HasForms
{
    use Tables\Concerns\InteractsWithTable, Actions\Concerns\InteractsWithActions, Forms\Concerns\InteractsWithForms;

    public ?string $plainTextToken = null;

    public $user;

    public function mount()
    {
        $this->user = Filament::getCurrentPanel()->auth()->user();
    }

    protected function getTableQuery()
    {
        $auth = Filament::getCurrentPanel()->auth();

        return app(Sanctum::$personalAccessTokenModel)->where([
            ['tokenable_id', '=', $auth->id()],
            ['tokenable_type', '=', $auth->user()->getMorphClass()],
        ]);
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('name')
                ->sortable()
                ->label('Token name'),

            Tables\Columns\TextColumn::make('created_at')
                ->date()
                ->label('Created at')
                ->sortable(),

            Tables\Columns\TextColumn::make('expires_at')
                ->color(fn ($record) => now()->gt($record->expires_at) ? 'danger' : null)
                ->date()
                ->label('Expired at')
                ->sortable(),

            Tables\Columns\TextColumn::make('abilities')
                ->badge()
                ->label('Abilities')
                ->getStateUsing(fn ($record) => count($record->abilities)),
        ];
    }

    protected function getSanctumFormSchema(bool $edit = false): array
    {
        return [
            Forms\Components\TextInput::make('token_name')
                ->label('Token name')
                ->required()
                ->hidden($edit),

            Forms\Components\DatePicker::make('expires_at')
                ->label('Expires at'),
        ];
    }

    protected function getTableHeaderActions(): array
    {
        return [
            Tables\Actions\Action::make('create_token')
                ->label('Create token')
                ->modalWidth('md')
                ->form($this->getSanctumFormSchema())
                ->action(function ($data) {
                    $this->plainTextToken = $this->user->createToken($data['token_name'], ['*'], $data['expires_at'] ? Carbon::createFromFormat('Y-m-d', $data['expires_at']) : null)->plainTextToken;

                    Notification::make()
                        ->success()
                        ->title('Token created successfully')
                        ->send();
                }),
        ];
    }

    protected function getTableActions(): array
    {
        return [
            Tables\Actions\EditAction::make('edit')
                ->iconButton()
                ->modalWidth('md')
                ->form($this->getSanctumFormSchema(edit: true)),

            Tables\Actions\DeleteAction::make()
                ->iconButton(),
        ];
    }

    public function render()
    {
        return view('livewire.sanctum-tokens');
    }
}
