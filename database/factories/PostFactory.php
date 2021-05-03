<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $images = [
            null,
            $this->faker->imageUrl(),
            'https://i.pinimg.com/originals/81/c3/3a/81c33af00010a4b7a05b3f35cb9943b9.jpg',
            'https://www.pandotrip.com/wp-content/uploads/2016/07/li-Photo-by-Santo-980x572.jpg'
        ];
        $publicity = ['friends', 'public'];
        $dt = $this->faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now');
        //$date = $dt->format("Y-m-d"); // 1994-09-24
        return [
            'body' => $this->faker->text(150),
            'publicity' => $publicity[mt_rand(0, 1)],
            'image' => $images[mt_rand(0, 3)],
            'created_at' => $dt,
            'updated_at' => $dt,
        ];
    }
}
