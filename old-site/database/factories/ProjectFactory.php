<?php

namespace Database\Factories;

use App\Models\Area;
use App\Models\Project;
// use Faker\Provider\Lorem;
use App\Models\ProjectType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Project::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $no = 1;
        $name = $this->faker->sentence($nbWords = 3, $variableNbWords = true);
        $slug = Str::slug($name);
        return [
            'name' => $name,
            'address' => $this->faker->address(),
            'rooms' => $this->faker->numberBetween(1, 5) . ' Bedroom',
            'area' => $this->faker->randomElement(Area::pluck('id')),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
            'installment_length' => $this->faker->numberBetween(12, 36),
            'project_type_id' => $this->faker->randomElement(ProjectType::pluck('id')),
            'progress' => $this->faker->randomElement(['Underconstruction', 'Completed']),
            'details' => $this->faker->sentence(),
            'slug' => $slug,
            'property_id' => bin2hex(random_bytes(2)),
        ];
    }
}
