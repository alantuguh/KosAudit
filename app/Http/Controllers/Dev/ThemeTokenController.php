<?php

namespace App\Http\Controllers\Dev;

use App\Http\Controllers\Controller;
use App\Support\DevTokenRegistry;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Alat developer (hanya environment local).
 * Menulis nilai token ke resources/css/foundations/tokens.css.
 *
 * Pengaman:
 * - hanya token pada DevTokenRegistry
 * - tipe dan rentang nilai dicek di server
 * - nilai disusun ulang dari template, bukan teks bebas
 * - hanya satu baris per token yang diganti, di blok yang benar
 * - backup tokens.css.bak dan penulisan lewat file sementara
 */
class ThemeTokenController extends Controller
{
    private const BLOCKS = [
        'light' => '/^:root,\s*\r?\n\[data-theme="light"\]\s*\{/m',
        'dark' => '/^\[data-theme="dark"\]\s*\{/m',
        'global' => '/^:root\s*\{/m',
    ];

    private const UNITS = [
        'px' => 'px',
        'rem' => 'rem',
        'em' => 'em',
        'percent' => '%',
        'number' => '',
    ];

    public function apply(Request $request): JsonResponse
    {
        abort_unless(app()->environment('local'), 404);

        $input = $request->validate([
            'theme' => ['required', 'in:light,dark'],
            'tokens' => ['required', 'array', 'min:1', 'max:60'],
            'tokens.*' => ['required'],
        ]);

        $rules = DevTokenRegistry::rules();
        $byBlock = [];

        foreach ($input['tokens'] as $name => $value) {
            if (! isset($rules[$name])) {
                return $this->fail("Token tidak diizinkan: {$name}");
            }

            $clean = $this->sanitize($rules[$name], $value);

            if ($clean === null) {
                return $this->fail("Nilai {$name} tidak valid atau di luar rentang.");
            }

            $block = $rules[$name]['scope'] === 'global' ? 'global' : $input['theme'];
            $byBlock[$block][$name] = $clean;
        }

        $path = resource_path('css/foundations/tokens.css');

        if (! is_file($path) || ! is_writable($path)) {
            return $this->fail('tokens.css tidak ditemukan atau tidak dapat ditulis.');
        }

        $content = file_get_contents($path);
        $updated = $content;
        $error = null;

        foreach ($byBlock as $block => $items) {
            $updated = $this->updateBlock($updated, $block, $items, $rules, $error);

            if ($updated === null) {
                return $this->fail($error);
            }
        }

        if ($updated === $content) {
            return response()->json(['message' => 'Tidak ada perubahan pada file.']);
        }

        if (substr_count($updated, "\n") !== substr_count($content, "\n")) {
            return $this->fail('Jumlah baris berubah, penulisan dibatalkan.');
        }

        copy($path, $path . '.bak');

        $temp = $path . '.tmp';

        if (file_put_contents($temp, $updated, LOCK_EX) === false) {
            return $this->fail('Gagal menulis file sementara.');
        }

        if (! @rename($temp, $path)) {
            $written = file_put_contents($path, $updated, LOCK_EX) !== false;
            @unlink($temp);

            if (! $written) {
                return $this->fail('Gagal menulis tokens.css.');
            }
        }

        return response()->json([
            'message' => sprintf('%d token diperbarui di tokens.css.', count($input['tokens'])),
        ]);
    }

    private function sanitize(array $rule, mixed $value): float|string|null
    {
        if ($rule['type'] === 'hex') {
            return is_string($value) && preg_match('/^#[0-9a-fA-F]{6}$/', $value)
                ? strtolower($value)
                : null;
        }

        if (! is_numeric($value)) {
            return null;
        }

        $number = (float) $value;

        if ($number < $rule['min'] - 1e-9 || $number > $rule['max'] + 1e-9) {
            return null;
        }

        return $number;
    }

    private function updateBlock(string $content, string $block, array $items, array $rules, ?string &$error): ?string
    {
        if (! preg_match(self::BLOCKS[$block], $content, $match, PREG_OFFSET_CAPTURE)) {
            $error = "Blok {$block} tidak ditemukan di tokens.css.";

            return null;
        }

        $bodyStart = $match[0][1] + strlen($match[0][0]);
        $end = strpos($content, '}', $bodyStart);

        if ($end === false) {
            $error = "Penutup blok {$block} tidak ditemukan.";

            return null;
        }

        $body = substr($content, $bodyStart, $end - $bodyStart);

        foreach ($items as $name => $value) {
            $pattern = '/^([ \t]*' . preg_quote($name, '/') . ':[ \t]*)([^;\r\n]+)(;)/m';

            if (preg_match_all($pattern, $body, $found) !== 1) {
                $error = "Baris {$name} tidak ditemukan tepat satu kali di blok {$block}.";

                return null;
            }

            $new = $this->rewrite($found[2][0], $rules[$name], $value);

            if ($new === null) {
                $error = "Format nilai {$name} tidak dikenali: {$found[2][0]}";

                return null;
            }

            $body = preg_replace_callback(
                $pattern,
                fn(array $m) => $m[1] . $new . $m[3],
                $body,
                1
            );
        }

        return substr($content, 0, $bodyStart) . $body . substr($content, $end);
    }

    /** Menyusun nilai baru dengan mempertahankan format aslinya. */
    private function rewrite(string $current, array $rule, float|string $value): ?string
    {
        $current = trim($current);
        $type = $rule['type'];

        if ($type === 'hex') {
            return preg_match('/^#[0-9a-fA-F]{6}$/', $current) ? (string) $value : null;
        }

        if ($type === 'alpha') {
            $pattern = '/^rgba\(\s*(\d{1,3})\s*,\s*(\d{1,3})\s*,\s*(\d{1,3})\s*,\s*[0-9.]+\s*\)$/';

            if (! preg_match($pattern, $current, $c)) {
                return null;
            }

            return sprintf('rgba(%d, %d, %d, %s)', $c[1], $c[2], $c[3], $this->number((float) $value));
        }

        $unit = self::UNITS[$type];
        $pattern = '/^-?(?:\d+\.?\d*|\.\d+)' . preg_quote($unit, '/') . '$/';

        if (! preg_match($pattern, $current)) {
            return null;
        }

        return $this->number((float) $value) . $unit;
    }

    private function number(float $value): string
    {
        return rtrim(rtrim(number_format($value, 4, '.', ''), '0'), '.');
    }

    private function fail(?string $message): JsonResponse
    {
        return response()->json(['message' => $message ?? 'Terjadi kesalahan.'], 422);
    }
}
