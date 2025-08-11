<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Model;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectOwnersFactory extends Factory
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
            'user_id' => $this->faker->randomElement(User::pluck('id')),
            'project_id' => $this->faker->randomElement(Project::pluck('id')),
        ];
    }
}
