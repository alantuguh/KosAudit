<?php

namespace Database\Seeders;

use App\Enums\RoomStatus;
use App\Models\MasterItem;
use App\Models\Room;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    private const TYPE_STANDARD = 'Standar';
    private const TYPE_AC = 'AC';
    private const TYPE_AC_BATHROOM = 'AC + KM Dalam';

    public function run(): void
    {
        // Status 'terisi' sengaja tidak di-seed: status itu diatur oleh modul sewa,
        // jadi kamar terisi tanpa data sewa akan membuat data tidak konsisten.
        $rooms = [
            ['101', self::TYPE_STANDARD, 800_000, RoomStatus::Available],
            ['102', self::TYPE_STANDARD, 800_000, RoomStatus::Available],
            ['103', self::TYPE_STANDARD, 800_000, RoomStatus::NeedsRepair],
            ['201', self::TYPE_AC, 1_200_000, RoomStatus::Available],
            ['202', self::TYPE_AC, 1_200_000, RoomStatus::Available],
            ['203', self::TYPE_AC_BATHROOM, 1_500_000, RoomStatus::Available],
            ['204', self::TYPE_AC_BATHROOM, 1_500_000, RoomStatus::Available],
        ];

        $items = MasterItem::pluck('id', 'name');

        foreach ($rooms as [$number, $type, $price, $status]) {
            $room = Room::updateOrCreate(
                ['room_number' => $number],
                ['type' => $type, 'monthly_price' => $price, 'status' => $status],
            );

            $room->masterItems()->sync(
                $this->itemsForType($type, $items->all())
            );
        }
    }

    /**
     * Susun data pivot [master_item_id => ['quantity' => n]] sesuai tipe kamar.
     *
     * @param  array<string, int>  $itemIds  [nama => id]
     * @return array<int, array{quantity: int}>
     */
    private function itemsForType(string $type, array $itemIds): array
    {
        $base = [
            'Kasur' => 1, 'Bantal' => 1, 'Lemari' => 1, 'Meja' => 1, 'Kursi' => 1,
            'Lampu' => 1, 'Stop Kontak' => 2, 'Kunci Pintu' => 1, 'Pintu' => 1,
            'Jendela' => 1, 'Dinding' => 1, 'Lantai' => 1,
        ];

        $extra = match ($type) {
            self::TYPE_STANDARD => ['Kipas Angin' => 1],
            self::TYPE_AC => ['AC' => 1],
            self::TYPE_AC_BATHROOM => ['AC' => 1, 'Lampu' => 2, 'Kran Air' => 1, 'Shower' => 1, 'Kloset' => 1],
            default => [],
        };

        $pivot = [];

        foreach (array_merge($base, $extra) as $name => $quantity) {
            if (isset($itemIds[$name])) {
                $pivot[$itemIds[$name]] = ['quantity' => $quantity];
            }
        }

        return $pivot;
    }
}
