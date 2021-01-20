<?php declare(strict_types=1);

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

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
    public function definition(): array
    {
        return [
            'title' => ucfirst($this->faker->word),
            'slug' => $this->faker->unique()->slug,
            'description' => $this->faker->realText(),
            'deleted_at' => function () {
                return $this->faker->boolean(20)
                    ? now()
                    : null;
            },
        ];
    }
}
