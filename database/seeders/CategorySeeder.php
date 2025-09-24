<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['en' => 'Politics',      'bn' => 'রাজনীতি'],
            ['en' => 'Sports',        'bn' => 'খেলাধুলা'],
            ['en' => 'Technology',    'bn' => 'প্রযুক্তি'],
            ['en' => 'Entertainment', 'bn' => 'বিনোদন'],
            ['en' => 'Education',     'bn' => 'শিক্ষা'],
            ['en' => 'Health',        'bn' => 'স্বাস্থ্য'],
            ['en' => 'World',         'bn' => 'বিশ্ব'],
            ['en' => 'Finance',       'bn' => 'অর্থনীতি'],
            ['en' => 'Environment',   'bn' => 'পরিবেশ'],
            ['en' => 'Lifestyle',     'bn' => 'জীবনধারা'],
            ['en' => 'National',      'bn' => 'জাতীয়'],
            ['en' => 'Country',       'bn' => 'দেশ'],
            ['en' => 'International', 'bn' => 'আন্তর্জাতিক'] // <-- Added International
        ];



        foreach ($categories as $index => $cat) {
            DB::table('categories')->insert([
                'id' => $index + 1,
                'category_en' => $cat['en'],
                'category_bn' => $cat['bn'],
                'slug' => Str::slug($cat['en']), // auto slug from English name
                'order' => $index + 1, // keep insertion order
                'status' => rand(0, 1),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
