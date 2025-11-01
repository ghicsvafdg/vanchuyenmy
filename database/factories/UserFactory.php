<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'username' => 'admin4',
            'email' => 'admin4@admin.com',
            'password' => bcrypt('12345678'),
            'role' => 0,
            'status' => 1,
            'remember_token' => Str::random(10),
        ];
    }
}
