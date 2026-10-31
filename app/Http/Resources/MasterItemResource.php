<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\MasterItem
 */
class MasterItemResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            // Hanya muncul saat item ditampilkan sebagai bagian dari kamar.
            'quantity' => $this->whenPivotLoaded('room_master_item', fn () => $this->pivot->quantity),
            'rooms_count' => $this->whenCounted('rooms'),
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
