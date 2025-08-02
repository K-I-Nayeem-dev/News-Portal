<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => rand(1, 10),
            'thumbnail' => $this->faker->imageUrl(640, 480, 'news'),
            'user_id' => rand(1, 10),
            'title_en' => $this->faker->sentence,
            'details_en' => $this->faker->paragraph(10),
            'created_at' => now(),
            'updated_at' => now(),
            'url' => $this->faker->unique()->slug,
            'status' => $this->faker->boolean ? 1 : 0,
            'news_photo' => $this->faker->imageUrl(800, 600, 'news'),
            'news_source' => $this->faker->company,
            'image_title' => $this->faker->sentence,
            'sub_cate_id' => rand(1, 5),
            'update_by_user' => rand(1, 10),
            'title_bn' => $this->faker->realText(50),
            'details_bn' => $this->faker->realText(200),
            'tags_en' => implode(',', $this->faker->words(3)),
            'tags_bn' => implode(',', $this->faker->words(3)),
            'dist_id' => rand(1, 64),
            'sub_dist_id' => rand(1, 100),
            'division_id' => rand(1, 8),
            'firstSection_bigThumbnail' => 'on',
            'firstSection' => 'on',
            'genaralBigThumbnail' => 'on',
        ];
    }
}