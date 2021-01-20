<?php declare(strict_types=1);

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
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
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'slug' => $this->faker->unique()->slug,
            'text' => $this->faker->realText(),
            'user_id' => function () {
                return User::factory()->create()->id;
            },
            'deleted_at' => function () {
                return $this->faker->boolean(20)
                    ? $this->faker->dateTimeBetween('-1 month')
                    : null;
            },
        ];
    }
}
