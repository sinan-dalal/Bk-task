<?php

namespace Database\Factories;

use App\Models\School;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->firstName,
            'school_id'=>$this->createOrRandomFactory(School::class),
        ];
    }

    function createOrRandomFactory($class_name)
    {
        $class = new $class_name();

        if ($class::count()) {
            return $class::inRandomOrder()->first();
        }

        return $class_name::factory()->create();
    }
}
