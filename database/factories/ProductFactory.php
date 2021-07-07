<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id'=>Category::all()->random()->id,
            'title'=>$this->faker->text(100),
            'description'=>$this->faker->realText,
            'price'=>random_int(100,1000),

        ];
    }
}
