<?php

use Illuminate\Database\Seeder;
use App\Models\User;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(TagTableSeeder::class);
        $this->call(ProductCategoryTableSeeder::class);
        $this->call(PostCategoryTableSeeder::class);
    }
}
