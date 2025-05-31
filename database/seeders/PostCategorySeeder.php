<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $post_categories = [
            ['post_id' => 1, 'category_id' => 1],
            ['post_id' => 1, 'category_id' => 2],
        ];

        DB::table('post_categories')->insert($post_categories);
    }
}
