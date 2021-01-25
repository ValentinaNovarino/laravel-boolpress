<?php

use Illuminate\Database\Seeder;
use App\Post;
use Faker\Generator as Faker;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 99; $i++) {
            $new_post = new Post();
            $new_post->author = $faker->name();
            $new_post->title = $faker->words(3,true);
            $new_post->subtitle = $faker->sentence();
            $new_post->images = $faker->imageUrl(360, 360, 'animals', true);
            $new_post->content = $faker->text(500);
            $new_post->category = $faker->word();
            $new_post->date = $faker->date();
            $new_post->save();
        };
    }
}
