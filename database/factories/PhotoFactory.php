<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PhotoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Photo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => Str::random(15),
            'description' => $this->faker->realText($maxNbChars = 200, $indexSize = 2),
            'story' => $this->faker->realText($maxNbChars = 200, $indexSize = 2),
            'location' => $this->faker->address,
            'date' => $this->faker->dateTimeBetween(),
            'photo_url' => Storage::url('test.jpg'),

            'user_id' => User::factory(),
            'category_id' => Category::factory(),

        ];
    }
}
