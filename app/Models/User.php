<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Laravel\Cashier\Order\Contracts\ProvidesInvoiceInformation;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements FilamentUser, ProvidesInvoiceInformation
{
    use HasApiTokens, HasFactory, Notifiable, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function canAccessPanel(\Filament\Panel $panel): bool
    {
        return true;
    }

    public function mollieCustomerFields(): array
    {
        return [
            'email' => $this->email,
            'name' => $this->name,
        ];
    }

    /**
     * Get the receiver information for the invoice.
     * Typically includes the name and some sort of (E-mail/physical) address.
     *
     * @return array An array of strings
     */
    public function getInvoiceInformation(): array
    {
        return [$this->name, $this->email];
    }

    /**
     * Get additional information to be displayed on the invoice. Typically a note provided by the customer.
     *
     * @return string|null
     */
    public function getExtraBillingInformation(): string | null
    {
        return null;
    }

    public function apiUsages(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ApiUsage::class);
    }

    public function getApiRequestsCurrentMonthAttribute(): int
    {
        return $this->apiUsages()
            ->whereMonth('date', now()->month)
            ->sum('request_count');
    }
}
