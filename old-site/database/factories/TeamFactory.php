<?php

namespace Database\Factories;

use App\Models\Team;
use App\Models\Builder;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeamFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Team::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->sentence($nbWords = 4, $variableNbWords = true);
        $slug = Str::slug($name);
        return [
            'team_lead_id' => $this->faker->randomElement(Builder::pluck('id')),
            'name' => $name,
            'slug' => $slug,
            'description' => $this->faker->sentence($nbWords = 12, $variableNbWords = true),
        ];
    }
}
