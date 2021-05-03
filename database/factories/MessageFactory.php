<?php

namespace Database\Factories;

use App\Models\Message;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Message::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $dt = $this->faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now');
        //$date = $dt->format("Y-m-d"); // 1994-09-24
        return [
            'message' => $this->faker->sentence,
            'created_at' => $dt
        ];
    }
}
