<?php

namespace Database\Factories;

use App\Models\Model;
use App\Models\RoomType;
use App\Models\Unit;
use Illuminate\Database\Eloquent\Factories\Factory;

class UnitRoomsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Model::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'room_type_id' => $this->faker->randomElement(RoomType::pluck('id')),
            'unit_id' => $this->faker->randomElement(Unit::pluck('id')),
        ];
    }
}
