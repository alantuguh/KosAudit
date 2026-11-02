<?php

namespace App\Enums;

enum RoomStatus: string
{
    case Available = 'kosong';
    case Occupied = 'terisi';
    case NeedsRepair = 'butuh_perbaikan';

    public function label(): string
    {
        return match ($this) {
            self::Available => 'Kosong',
            self::Occupied => 'Terisi',
            self::NeedsRepair => 'Butuh Perbaikan',
        };
    }

    /**
     * @return array<int, string>
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
