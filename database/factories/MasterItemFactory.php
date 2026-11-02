<?php

namespace Database\Factories;

use App\Models\MasterItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<MasterItem>
 */
class MasterItemFactory extends Factory
{
    protected $model = MasterItem::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => ucfirst(fake()->unique()->words(2, true)),
            'description' => null,
        ];
    }
}
