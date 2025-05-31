<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [
            'title' => 'Demo Post', 'user_id' => 2, 'slug' => 'demo-post',
            'description' => 'This is a demo post for testing purposes.',
            'is_published' => 1
        ];

        DB::table('posts')->insert($posts);
    }
}
