<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Support\Str;
use App\Models\User;

class CourseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Course::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence();

        return [
            'title' => $this->faker->sentence(),
            'subtitle' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'status' => $this->faker->randomElement([Course::BORRADOR, Course::REVISION, Course::PUBLICADO]),
            'slug' => Str::slug($title),
            'user_id' => 1,
            'category_id' => Category::all()->random()->id,
        ];
    }
}
