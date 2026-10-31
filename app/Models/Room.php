<?php

namespace App\Models;

use App\Enums\RoomStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'room_number',
        'type',
        'monthly_price',
        'status',
        'description',
    ];

    /**
     * Default di level model, selaras dengan default di migration.
     *
     * @var array<string, mixed>
     */
    protected $attributes = [
        'status' => 'kosong',
    ];

    protected function casts(): array
    {
        return [
            'monthly_price' => 'integer',
            'status' => RoomStatus::class,
        ];
    }

    public function isAvailable(): bool
    {
        return $this->status === RoomStatus::Available;
    }

    // ---------------------------------------------------------------------
    // Scopes
    // ---------------------------------------------------------------------

    public function scopeAvailable(Builder $query): Builder
    {
        return $query->where('status', RoomStatus::Available->value);
    }

    public function scopeStatus(Builder $query, RoomStatus|string $status): Builder
    {
        $value = $status instanceof RoomStatus ? $status->value : $status;

        return $query->where('status', $value);
    }

    // ---------------------------------------------------------------------
    // Relasi
    // ---------------------------------------------------------------------

    /**
     * Item kondisi yang ada di kamar ini (pivot room_master_item).
     */
    public function masterItems(): BelongsToMany
    {
        return $this->belongsToMany(MasterItem::class, 'room_master_item')
            ->withPivot('quantity')
            ->withTimestamps();
    }

    /**
     * Riwayat sewa kamar ini.
     * Model Rental dibuat oleh modul transaksi sewa (FK: rentals.room_id).
     */
    public function rentals(): HasMany
    {
        return $this->hasMany(Rental::class);
    }
}
