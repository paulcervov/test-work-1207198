<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::factory(50)
            ->make(['user_id' => null])
            ->each(function (Post $post) {
                $user = User::inRandomOrder()->first();
                $categories = Category::inRandomOrder()->limit(rand(1, 3))->get();
                $post->user()->associate($user);
                $post->save();
                $post->categories()->attach($categories);
            });
    }
}
