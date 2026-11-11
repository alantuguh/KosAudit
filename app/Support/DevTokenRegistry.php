<?php

namespace App\Support;

/**
 * Daftar token yang boleh disetel dari UI Playground (khusus local).
 * Dipakai bersama oleh halaman (membuat kontrol) dan server (validasi).
 */
class DevTokenRegistry
{
    private const GLASS_LEVELS = ['premium', 'subtle'];

    private const GLASS_PROPS = [
        'bg' => ['alpha', 0, 0.8],
        'border' => ['alpha', 0, 1],
        'highlight' => ['alpha', 0, 1],
        'blur' => ['px', 0, 24],
    ];

    /** Kontrol untuk halaman Component Preview, per grup. */
    public static function componentGroups(): array
    {
        return [
            'Bentuk & ukuran' => [
                self::token('--ui-radius-control', 'Radius button & input', 'rem', 0, 1.5, 0.0625),
                self::token('--ui-radius-card', 'Radius card', 'rem', 0, 2, 0.0625),
                self::token('--ui-control-height', 'Tinggi button & input', 'rem', 2.25, 3.5, 0.125),
            ],

            'Font' => [
                self::token('--ui-heading-weight', 'Bobot heading', 'number', 500, 700, 100),
                self::token('--ui-heading-tracking', 'Jarak huruf heading', 'em', -0.06, 0, 0.005),
                self::token('--ui-btn-font-size', 'Ukuran font tombol', 'rem', 0.75, 1.125, 0.0625),
                self::token('--ui-btn-font-weight', 'Bobot font tombol', 'number', 400, 800, 100),
            ],

            'Hover & interaksi' => [
                self::token('--ui-btn-hover-lift', 'Angkat tombol saat hover', 'px', 0, 4, 0.5),
                self::token('--ui-card-hover-lift', 'Angkat card saat hover', 'px', 0, 6, 0.5),
                self::token('--ui-btn-hover-brightness', 'Kecerahan tombol saat hover', 'number', 1, 1.3, 0.01),
                self::token('--ui-btn-press-scale', 'Skala tombol saat ditekan', 'number', 0.9, 1, 0.01),
            ],

            'Tombol sekunder & alert' => [
                self::token('--ui-btn-secondary-bg', 'Isi tombol sekunder', 'percent', 0, 40, 1),
                self::token('--ui-btn-secondary-bg-hover', 'Isi tombol sekunder (hover)', 'percent', 0, 60, 1),
                self::token('--ui-btn-secondary-border', 'Border tombol sekunder', 'percent', 0, 80, 1),
                self::token('--ui-btn-secondary-border-hover', 'Border tombol sekunder (hover)', 'percent', 0, 100, 1),
                self::token('--ui-alert-tint', 'Tint alert', 'percent', 0, 40, 1),
                self::token('--ui-alert-border', 'Border alert', 'percent', 0, 100, 1),
            ],

            'Warna (tema aktif)' => [
                self::token('--ui-brand-400', 'Brand 400 (awal gradien)', 'hex', scope: 'theme'),
                self::token('--ui-brand-500', 'Brand 500 (checkbox)', 'hex', scope: 'theme'),
                self::token('--ui-brand-700', 'Brand 700 (akhir gradien)', 'hex', scope: 'theme'),
                self::token('--ui-input-focus', 'Warna fokus input', 'hex', scope: 'theme'),
                self::token('--ui-input-bg', 'Opacity isi input', 'alpha', 0, 0.9, 0.01, 'theme'),
                self::token('--ui-success', 'Success', 'hex', scope: 'theme'),
                self::token('--ui-warning', 'Warning', 'hex', scope: 'theme'),
                self::token('--ui-danger', 'Danger', 'hex', scope: 'theme'),
                self::token('--ui-info', 'Info', 'hex', scope: 'theme'),
                self::token('--ui-text', 'Teks utama', 'hex', scope: 'theme'),
                self::token('--ui-text-secondary', 'Teks sekunder', 'hex', scope: 'theme'),
                self::token('--ui-text-muted', 'Teks muted & placeholder', 'hex', scope: 'theme'),
            ],
        ];
    }

    /** Semua aturan (glass + komponen), diindeks nama token. */
    public static function rules(): array
    {
        $rules = [];

        foreach (self::GLASS_LEVELS as $level) {
            foreach (self::GLASS_PROPS as $prop => [$type, $min, $max]) {
                $rules["--glass-{$level}-{$prop}"] = [
                    'type' => $type,
                    'min' => $min,
                    'max' => $max,
                    'scope' => 'theme',
                ];
            }
        }

        foreach (self::componentGroups() as $tokens) {
            foreach ($tokens as $token) {
                $rules[$token['name']] = $token;
            }
        }

        return $rules;
    }

    private static function token(
        string $name,
        string $label,
        string $type,
        float|int $min = 0,
        float|int $max = 1,
        float|int $step = 1,
        string $scope = 'global',
    ): array {
        return compact('name', 'label', 'type', 'min', 'max', 'step', 'scope');
    }
}
