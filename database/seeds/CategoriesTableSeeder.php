<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 4 ; $i++) {
            $new_category = new Category();
            $new_category->name = $faker->words(3,true);
            $slug = Str::slug($new_category->name);
            $slug_base = $slug;
            $counter = 1;
            $post_current = Category::where('slug', $slug)->first();
            while($post_current) {
                $slug = $slug_base .'-' .$counter;
                $counter++;
                $post_current = Category::where('slug', $slug)->first();
            }
            $new_category->slug = $slug;
            $new_category->save();
        }
    }
}
