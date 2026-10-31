<?php

namespace Database\Factories;

use App\Enums\RoomStatus;
use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Room>
 */
class RoomFactory extends Factory
{
    protected $model = Room::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'room_number' => (string) fake()->unique()->numberBetween(100, 999),
            'type' => fake()->randomElement(['Standar', 'AC', 'AC + KM Dalam']),
            'monthly_price' => fake()->randomElement([800_000, 1_200_000, 1_500_000]),
            'status' => RoomStatus::Available,
            'description' => null,
        ];
    }

    public function occupied(): static
    {
        return $this->state(['status' => RoomStatus::Occupied]);
    }

    public function needsRepair(): static
    {
        return $this->state(['status' => RoomStatus::NeedsRepair]);
    }
}
