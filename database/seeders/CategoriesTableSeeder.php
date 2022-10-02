<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seed_categories = [
            [
                'name' => "category A",
                'user_id' => "1",
            ],
            [
                'name' => "category B",
                'user_id' => "1",
            ],
            [
                'name' => "category C",
                'user_id' => "2",
            ],
            [
                'name' => "category D",
                'user_id' => "2",
            ],
            [
                'name' => "category E",
                'user_id' => "3",
            ],
            [
                'name' => "category F",
                'user_id' => "3",
            ],
        ];

        Category::insert($seed_categories);
    }
}
