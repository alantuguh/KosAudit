<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterItem extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Kamar-kamar yang memiliki item ini (pivot room_master_item).
     */
    public function rooms(): BelongsToMany
    {
        return $this->belongsToMany(Room::class, 'room_master_item')
            ->withPivot('quantity')
            ->withTimestamps();
    }
}
