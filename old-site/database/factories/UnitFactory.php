<?php

namespace Database\Factories;

use App\Models\InstallmentType;
use App\Models\Measurement;
use App\Models\Project;
use App\Models\ProjectType;
use App\Models\Unit;
use Illuminate\Database\Eloquent\Factories\Factory;

class UnitFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Unit::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // static $no = 1;
        return [
            'title' => $this->faker->randomElement(['Type', 'Bronze', 'Silver', 'Golden']),
            'project_id' => $this->faker->randomElement(Project::pluck('id')),
            'rooms' => $this->faker->numberBetween(1, 5) . ' Bedroom',
            'covered_area' => $this->faker->numberBetween(50, 200),
            'measurement_type' => $this->faker->randomElement(Measurement::pluck('id')),
            'unit_type_id' => $this->faker->randomElement(ProjectType::pluck('id')),
            'price' => $this->faker->randomFloat(4, 0, 1000000),
            'monthly_installment' => $this->faker->randomFloat(4, 0, 1000000),
            'installment' => $this->faker->randomFloat(4, 0, 1000000),
            'installment_type' => $this->faker->randomElement(InstallmentType::pluck('id')),
            // 'installment_length' => $this->faker->numberBetween(5, 60),
            'down_payment' => $this->faker->randomFloat(4, 0, 1000000),
            // 'possession' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
        ];
    }
}
