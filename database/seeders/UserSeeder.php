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

        foreach ([
            ['name' => 'Sophie Jansen', 'email' => 'sophie@dishdelights.test'],
            ['name' => 'Lucas de Boer', 'email' => 'lucas@dishdelights.test'],
        ] as $userData) {
            User::updateOrCreate(
                ['email' => $userData['email']],
                [
                    ...$userData,
                    'password' => 'password',
                    'role' => 'user',
                    'image_path' => 'profile_pictures/Cjs11RPAaDyMVJ8F2Z0bdMSCrPi9FGY78e6E5W8W.jpg',
                    'email_verified_at' => now(),
                ],
            );
        }
    }
}
