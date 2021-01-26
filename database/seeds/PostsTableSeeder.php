<?php

use Illuminate\Database\Seeder;
use App\Post;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 10; $i++) {
            $new_post = new Post();
            $new_post->title = $faker->sentence();
            $new_post->content = $faker->text(500);
            // slug = titolo con - al posto degli spazi
            $slug = Str::slug($new_post->title);
            // salvo una copia da utilizzare nel ciclo while
            $slug_base = $slug;
            // creo un contatore
            $counter = 1;
            // recupero il post corrente ed il suo slug lo ciclo e verifico che sia unico nel database
            $post_current = Post::where('slug', $slug)->first();
            while($post_current) {
                $slug = $slug_base .'-' .$counter;
                $counter++;
                $post_current = Post::where('slug', $slug)->first();
            }
            $new_post->slug = $slug;
            $new_post->save();
        };
    }
}
