<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use Illuminate\Database\Seeder;

class IngredientSeeder extends Seeder
{
    public function run(): void
    {
        foreach ([
            'Ui', 'Knoflook', 'Olijfolie', 'Tomaat', 'Paprika', 'Wortel',
            'Aardappel', 'Rijst', 'Pasta', 'Kipfilet', 'Eieren', 'Melk',
            'Bloem', 'Boter', 'Parmezaanse kaas', 'Kikkererwten',
        ] as $name) {
            Ingredient::firstOrCreate(['name' => $name]);
        }
    }
}
