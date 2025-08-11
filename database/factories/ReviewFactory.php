<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Review;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Review::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'project_id' => $this->faker->randomElement(Project::pluck('id')),
            'user_id' => $this->faker->randomElement(User::pluck('id')),
            'rating' => $this->faker->numberBetween(0, 5),
            'review' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
        ];
    }
}
