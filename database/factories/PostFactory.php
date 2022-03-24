<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $users = User::pluck('id')->toArray();
        $title = $this->faker->sentence($nbwords = 6, $variableNbWords = true);
        $slug = Str::slug($title,'-');
        return [
            //
            'user_id' => $this->faker->randomElement($users),
            //'category_id' => $this->faker->numberBetween($min = 1, $max = 3),
            'photo_id' => $this->faker->numberBetween($min = 1, $max = 2),
            'title' => $title,
            'slug' => $slug,
            'body' => $this->faker->realText($maxNbChars = 200, $indexSize = 2),
        ];
    }
}
