<?php

namespace App\Http\Requests\Room;

use App\Enums\RoomStatus;
use App\Models\Room;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class UpdateRoomRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->isOwner() ?? false;
    }

    /**
     * Semua field memakai 'sometimes' sehingga PATCH sebagian field didukung.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        /** @var Room $room */
        $room = $this->route('room');

        return [
            'room_number' => ['sometimes', 'required', 'string', 'max:10', Rule::unique('rooms', 'room_number')->ignore($room)],
            'type' => ['sometimes', 'required', 'string', 'max:50'],
            'monthly_price' => ['sometimes', 'required', 'integer', 'min:0', 'max:4294967295'],
            'status' => ['sometimes', Rule::enum(RoomStatus::class)->only([RoomStatus::Available, RoomStatus::NeedsRepair])],
            'description' => ['nullable', 'string', 'max:1000'],

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

    /**
     * Kamar yang sedang terisi tidak boleh diubah statusnya secara manual.
     */
    public function after(): array
    {
        return [
            function (Validator $validator) {
                /** @var Room $room */
                $room = $this->route('room');

                if ($this->has('status') && $room->status === RoomStatus::Occupied) {
                    $validator->errors()->add(
                        'status',
                        'Kamar sedang terisi. Status akan berubah otomatis saat penghuni check-out.'
                    );
                }
            },
        ];
    }

    public function messages(): array
    {
        return RoomMessages::all();
    }
}
