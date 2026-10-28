<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@dishdelights.test'],
            [
                'name' => 'DishDelights Admin',
                'password' => 'password',
                'role' => 'admin',
                'image_path' => 'profile_pictures/Cjs11RPAaDyMVJ8F2Z0bdMSCrPi9FGY78e6E5W8W.jpg',
                'email_verified_at' => now(),
            ],
        );

        User::updateOrCreate(
            ['email' => 'sophie@dishdelights.test'],
            [
                'name' => 'Sophie Jansen',
                'password' => 'password',
                'role' => 'user',
                'image_path' => 'profile_pictures/Q4ilhysSUPqW08T6ahtRaXCwTvFBhs83uI2j5vrQ.webp',
                'email_verified_at' => now(),
            ],
        );

        User::updateOrCreate(
            ['email' => 'lucas@dishdelights.test'],
            [
                'name' => 'Lucas de Boer',
                'password' => 'password',
                'role' => 'user',
                'image_path' => null,
                'email_verified_at' => now(),
            ],
        );

    }
}
