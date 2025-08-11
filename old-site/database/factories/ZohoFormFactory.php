<?php

namespace Database\Factories;

use App\Models\Unit;
use App\Models\User;
use App\Models\Inquiry;
use App\Models\Project;
use App\Models\ZohoForm;
use Illuminate\Database\Eloquent\Factories\Factory;

class ZohoFormFactory extends Factory
{
   /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
   protected $model = Inquiry::class;

   /**
    * Define the model's default state.
    *
    * @return array
    */
   public function definition()
   {
      return [
         'user_id' => $this->faker->randomElement(User::pluck('id')),
         'name' => $this->faker->name(),
         'address' => $this->faker->address(),
         'message' => $this->faker->sentence(),
         'phone_number' => $this->faker->phoneNumber(),
         'email' => $this->faker->safeEmail(),
         'unit_id' => $this->faker->randomElement(Unit::pluck('id')),
         'project_id' => $this->faker->randomElement(Project::pluck('id')),
      ];
   }
}
