<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            ['name' => 'tag 1', 'taggable_type' => 'App\Models\Post', 'taggable_id' => 1],
            ['name' => 'tag 2', 'taggable_type' => 'App\Models\Post', 'taggable_id' => 1],
        ];

        DB::table('tags')->insert($tags);
    }
}
