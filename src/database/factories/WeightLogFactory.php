<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\WeightLog;

class WeightLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = WeightLog::class;
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'date' => $this->faker->date(),
            'weight' => $this->faker->randomFloat(1, 50, 70),
            'calories' => $this->faker->numberBetween(1500, 3000),
            'exercise_time' => $this->faker->time('H:i:s'),
            'exercise_content' => $this->faker->sentence(),
        ];
    }
}
