<?php

namespace App\Http\Requests\Room;

/**
 * Pesan validasi bersama untuk Store/UpdateRoomRequest.
 */
final class RoomMessages
{
    /**
     * @return array<string, string>
     */
    public static function all(): array
    {
        return [
            'room_number.required' => 'Nomor kamar wajib diisi.',
            'room_number.unique' => 'Nomor kamar sudah dipakai.',
            'room_number.max' => 'Nomor kamar maksimal 10 karakter.',
            'type.required' => 'Tipe kamar wajib diisi.',
            'monthly_price.required' => 'Harga sewa wajib diisi.',
            'monthly_price.integer' => 'Harga sewa harus berupa angka (tanpa titik/koma).',
            'monthly_price.min' => 'Harga sewa tidak boleh negatif.',
            'status.enum' => 'Status hanya boleh "kosong" atau "butuh_perbaikan". Status "terisi" diatur otomatis oleh modul sewa.',
            'items.array' => 'Format items harus berupa array.',
            'items.*.master_item_id.required' => 'master_item_id wajib diisi di setiap item.',
            'items.*.master_item_id.exists' => 'Item kondisi tidak ditemukan.',
            'items.*.master_item_id.distinct' => 'Item yang sama tidak boleh dimasukkan dua kali.',
            'items.*.quantity.min' => 'Jumlah item minimal 1.',
        ];
    }
}
