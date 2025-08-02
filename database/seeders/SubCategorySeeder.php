<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SubCategorySeeder extends Seeder
{
    public function run(): void
    {
        $sub_categories = [
            ['en' => 'National News',      'bn' => 'জাতীয় সংবাদ'],
            ['en' => 'Cricket',            'bn' => 'ক্রিকেট'],
            ['en' => 'Football',           'bn' => 'ফুটবল'],
            ['en' => 'Mobile & Gadgets',   'bn' => 'মোবাইল ও গ্যাজেট'],
            ['en' => 'Tech Updates',       'bn' => 'প্রযুক্তি হালনাগাদ'],
            ['en' => 'Movie Reviews',      'bn' => 'মুভি রিভিউ'],
            ['en' => 'TV Shows',           'bn' => 'টিভি শো'],
            ['en' => 'Higher Education',   'bn' => 'উচ্চ শিক্ষা'],
            ['en' => 'Study Abroad',       'bn' => 'বিদেশে পড়াশোনা'],
            ['en' => 'Medical Tips',       'bn' => 'চিকিৎসা পরামর্শ'],
            ['en' => 'Fitness',            'bn' => 'ফিটনেস'],
            ['en' => 'Global Affairs',     'bn' => 'আন্তর্জাতিক'],
            ['en' => 'Stock Market',       'bn' => 'শেয়ার বাজার'],
            ['en' => 'Personal Finance',   'bn' => 'ব্যক্তিগত অর্থ'],
            ['en' => 'Climate Change',     'bn' => 'জলবায়ু পরিবর্তন'],
            ['en' => 'Wildlife',           'bn' => 'বন্যপ্রাণী'],
            ['en' => 'Fashion Trends',     'bn' => 'ফ্যাশন ট্রেন্ড'],
            ['en' => 'Food & Recipes',     'bn' => 'খাদ্য ও রেসিপি'],
            ['en' => 'Travel Guide',       'bn' => 'ভ্রমণ গাইড'],
            ['en' => 'Parenting',          'bn' => 'প্যারেন্টিং'],
        ];

        foreach ($sub_categories as $index => $sub) {
            DB::table('sub_categories')->insert([
                'id' => $index + 1,
                'category_id' => rand(1, 10),
                'sub_cate_en' => $sub['en'],
                'sub_cate_bn' => $sub['bn'],
                'status' => rand(0,1),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
