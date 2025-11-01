<?php

use Illuminate\Database\Seeder;
use App\Models\ProductCategory;
class ProductCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\ProductCategory::factory()->count(10)->create();
    }
}
