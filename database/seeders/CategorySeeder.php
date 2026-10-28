<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        foreach ([
            'Ontbijt', 'Lunch', 'Diner', 'Dessert', 'Snack',
            'Nederlands', 'Italiaans', 'Aziatisch', 'Mexicaans',
            'Glutenvrij', 'Lactosevrij', 'Eiwitrijk', 'Gezond',
            'Snel', 'Budget',
        ] as $name) {
            Category::firstOrCreate(['name' => $name]);
        }
    }
}
