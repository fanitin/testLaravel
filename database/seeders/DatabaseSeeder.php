<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Tag;
use App\Models\Result;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Category::factory(15)->create();
        $tags = Tag::factory(50)->create();
        $results = Result::factory(100)->create();
        foreach($results as $result){
            $tagsIDs = $tags->random(random_int(1, 10))->pluck('id');
            $result->tags()->attach($tagsIDs);
        }
    }
}
