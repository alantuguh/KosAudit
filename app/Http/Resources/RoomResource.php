<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\Room
 */
class RoomResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'room_number' => $this->room_number,
            'type' => $this->type,
            'monthly_price' => $this->monthly_price,
            'status' => $this->status->value,
            'status_label' => $this->status->label(),
            'description' => $this->description,
            'master_items_count' => $this->whenCounted('masterItems'),
            'master_items' => MasterItemResource::collection($this->whenLoaded('masterItems')),
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
