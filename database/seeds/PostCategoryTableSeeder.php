<?php

use Illuminate\Database\Seeder;
use App\Models\PostCategory;
class PostCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\PostCategory::factory()->count(10)->create();
    }
}
