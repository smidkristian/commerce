<?php

namespace Database\Factories;

use App\Models\Product;
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
            'name' => $this->faker->name,
            'slug' => $this->faker->slug(3),
            'sku' => $this->faker->unique()->slug(2),
            'brand_id' => $this->faker->numberBetween(1, 10),
            'color' => $this->faker->safeColorName,
            'quantity' => $this->faker->numberBetween(1, 20),
            'weight' => $this->faker->numberBetween(12, 250),
            'price' => $this->faker->numberBetween(150, 20050),
            'sale_price' => $this->faker->numberBetween(80, 11250),
            'description' => $this->faker->text(300),
            'status' => $this->faker->boolean(50),
            'featured' => $this->faker->boolean(60)
        ];
    }
}
