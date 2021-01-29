<?php

use Illuminate\Database\Seeder;
use App\Tag;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 4 ; $i++) {
            $new_tag = new Tag();
            $new_tag->name = $faker->words(3,true);
            $slug = Str::slug($new_tag->name);
            $slug_base = $slug;
            $counter = 1;
            $tag_current = Tag::where('slug', $slug)->first();
            while($tag_current) {
                $slug = $slug_base .'-' .$counter;
                $counter++;
                $tag_current = Tag::where('slug', $slug)->first();
            }
            $new_tag->slug = $slug;
            $new_tag->save();
        }
    }
}
