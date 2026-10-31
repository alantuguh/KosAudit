<?php

namespace App\Http\Requests\Room;

use App\Enums\RoomStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRoomRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->isOwner() ?? false;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'room_number' => ['required', 'string', 'max:10', Rule::unique('rooms', 'room_number')],
            'type' => ['required', 'string', 'max:50'],
            'monthly_price' => ['required', 'integer', 'min:0', 'max:4294967295'],
            // 'terisi' tidak boleh diisi manual; diatur otomatis oleh modul sewa.
            'status' => ['sometimes', Rule::enum(RoomStatus::class)->only([RoomStatus::Available, RoomStatus::NeedsRepair])],
            'description' => ['nullable', 'string', 'max:1000'],

            // Daftar item di kamar: [{ "master_item_id": 1, "quantity": 2 }, ...]
            'items' => ['sometimes', 'array'],
            'items.*.master_item_id' => [
                'required',
                'integer',
                'distinct',
                Rule::exists('master_items', 'id')->whereNull('deleted_at'),
            ],
            'items.*.quantity' => ['nullable', 'integer', 'min:1', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return RoomMessages::all();
    }
}
