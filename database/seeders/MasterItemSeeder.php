<?php

namespace Database\Seeders;

use App\Models\MasterItem;
use Illuminate\Database\Seeder;

class MasterItemSeeder extends Seeder
{
    /**
     * Daftar item kondisi standar kos.
     */
    public const ITEMS = [
        'Kasur' => 'Kasur beserta rangka/dipan',
        'Bantal' => null,
        'Lemari' => 'Lemari pakaian',
        'Meja' => 'Meja belajar',
        'Kursi' => null,
        'AC' => 'Air conditioner beserta remote',
        'Kipas Angin' => null,
        'Lampu' => null,
        'Stop Kontak' => null,
        'Kunci Pintu' => 'Kunci dan anak kunci kamar',
        'Pintu' => null,
        'Jendela' => 'Kaca, engsel, dan gorden',
        'Dinding' => 'Cat dan permukaan dinding',
        'Lantai' => 'Keramik/ubin lantai',
        'Kran Air' => null,
        'Shower' => null,
        'Kloset' => null,
    ];

    public function run(): void
    {
        foreach (self::ITEMS as $name => $description) {
            MasterItem::updateOrCreate(
                ['name' => $name],
                ['description' => $description],
            );
        }
    }
}
