<?php

namespace App\Enums;

enum UserRole: string
{
    case Owner = 'owner';
    case Tenant = 'tenant';

    public function label(): string
    {
        return match ($this) {
            self::Owner => 'Pemilik Kos',
            self::Tenant => 'Penghuni',
        };
    }

    /**
     * Daftar value untuk validasi, contoh: Rule::in(UserRole::values()).
     *
     * @return array<int, string>
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
