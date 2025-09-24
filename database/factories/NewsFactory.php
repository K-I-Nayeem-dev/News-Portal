<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class NewsFactory extends Factory
{
    protected $model = \App\Models\News::class;

    public function definition(): array
    {
        $faker = \Faker\Factory::create();

        return [
            'category_id' => DB::table('categories')->inRandomOrder()->value('id') ?? 1,
            'thumbnail' => $faker->imageUrl(640, 480, 'news'),
            'user_id' => DB::table('users')->inRandomOrder()->value('id') ?? 1,
            'title_en' => $faker->sentence(4),
            'details_en' => $faker->paragraph(1),
            'url' => Str::slug($faker->word) . '-' . rand(1, 1000),
            'status' => 1, // Simplify - just set to 1
            'news_photo' => $faker->imageUrl(800, 600, 'news'),
            'news_source' => $faker->company,
            'image_title' => $faker->word,
            'sub_cate_id' => DB::table('sub_categories')->inRandomOrder()->value('id') ?? 1,
            'update_by_user' => DB::table('users')->inRandomOrder()->value('id') ?? 1,
            'title_bn' => $faker->word,
            'details_bn' => $faker->paragraph(1),
            'dist_id' => rand(1, 64),
            'sub_dist_id' => rand(1, 100),
            'division_id' => rand(1, 8),
            'firstSection_bigThumbnail' => 1,
            'firstSection' => 1,
            'trendyNews' => 1,
        ];
    }
}
