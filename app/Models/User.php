<?php

namespace App\Models;

use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'role',
        'password',
    ];

    /**
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => UserRole::class,
        ];
    }

    // ---------------------------------------------------------------------
    // Helpers role
    // ---------------------------------------------------------------------

    public function isOwner(): bool
    {
        return $this->role === UserRole::Owner;
    }

    public function isTenant(): bool
    {
        return $this->role === UserRole::Tenant;
    }

    public function hasRole(UserRole|string ...$roles): bool
    {
        foreach ($roles as $role) {
            $role = $role instanceof UserRole ? $role : UserRole::tryFrom($role);

            if ($this->role === $role) {
                return true;
            }
        }

        return false;
    }

    // ---------------------------------------------------------------------
    // Scopes
    // ---------------------------------------------------------------------

    public function scopeOwners(Builder $query): Builder
    {
        return $query->where('role', UserRole::Owner->value);
    }

    public function scopeTenants(Builder $query): Builder
    {
        return $query->where('role', UserRole::Tenant->value);
    }

    // ---------------------------------------------------------------------
    // Relasi
    // ---------------------------------------------------------------------

    /**
     * Riwayat sewa milik penghuni.
     * Model Rental dibuat oleh modul transaksi sewa (FK: rentals.tenant_id).
     */
    public function rentals(): HasMany
    {
        return $this->hasMany(Rental::class, 'tenant_id');
    }
}
