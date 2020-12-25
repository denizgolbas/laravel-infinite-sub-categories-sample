<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'parent_id' => null,
            'name' => $this->faker->unique()->text(15),
            'description' => $this->faker->text(200),
            'slug' => function (array $post) {
                return Str::slug($post['name']);
            },
        ];
    }

    public function child()
    {
        return $this->state(function (array $attributes) {
            return [
            'parent_id' => Category::all()->random()->id,
         ];
    }); 
    }

    public function grandchild()
    {
        return $this->state(function (array $attributes) {
            return [
            'parent_id' => Category::whereNotNull('parent_id')->get()->random()->id,
         ];
    });
    }
}
