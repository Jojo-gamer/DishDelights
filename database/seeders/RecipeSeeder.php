<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Database\Seeder;

class RecipeSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('email', 'admin@dishdelights.test')->firstOrFail();
        $categories = Category::query()->get()->keyBy('name');
        $ingredients = Ingredient::query()->get()->keyBy('name');

        foreach ($this->recipes() as $recipeData) {
            $recipe = Recipe::updateOrCreate(
                ['name' => $recipeData['name']],
                [
                    'description' => $recipeData['description'],
                    'prep_time' => $recipeData['prep_time'],
                    'instructions' => json_encode($recipeData['instructions']),
                    'image_path' => $recipeData['image_path'],
                    'status' => 'approved',
                    'is_active' => true,
                    'user_id' => $admin->id,
                ],
            );

            $recipe->categories()->sync(
                collect($recipeData['categories'])->map(fn (string $name): int => $categories[$name]->id),
            );
            $recipe->ingredients()->sync(
                collect($recipeData['ingredients'])->mapWithKeys(
                    fn (string $amount, string $name): array => [$ingredients[$name]->id => ['amount' => $amount]],
                )->all(),
            );
            $recipe->comments()->delete();
        }
    }

    private function recipes(): array
    {
        return [
            [
                'name' => 'Romige tomatenpasta',
                'description' => 'Een snelle en romige pasta met geroosterde tomaten, knoflook en Parmezaanse kaas.',
                'prep_time' => 30,
                'instructions' => ['Kook de pasta beetgaar.', 'Bak de ui en knoflook.', 'Voeg tomaat en room toe.', 'Meng alles met Parmezaanse kaas.'],
                'categories' => ['Diner'],
                'ingredients' => ['Pasta' => '300 g', 'Tomaat' => '400 g', 'Knoflook' => '2 tenen', 'Olijfolie' => '2 el', 'Parmezaanse kaas' => '50 g'],
                'image_path' => 'recipes/yWEJnQkfrZLm4wZzVuXsa0GtZFABthcvmNyvj1EU.jpg',
            ],
            [
                'name' => 'Krokante groentebowl',
                'description' => 'Een kleurrijke bowl met rijst, geroosterde groenten en knapperige kikkererwten.',
                'prep_time' => 40,
                'instructions' => ['Kook de rijst.', 'Rooster de groenten en kikkererwten.', 'Verdeel alles over kommen.', 'Werk af met olijfolie.'],
                'categories' => ['Lunch', 'Gezond'],
                'ingredients' => ['Rijst' => '250 g', 'Paprika' => '2 stuks', 'Wortel' => '2 stuks', 'Kikkererwten' => '1 blik', 'Olijfolie' => '2 el'],
                'image_path' => 'recipes/wIEIWwTbfKfauULupnrVDc0N02LytEzBM2z6VB9a.jpg',
            ],
            [
                'name' => 'Hartige kip met aardappelen',
                'description' => 'Malse kipfilet uit de oven met kruidige aardappelen en geroosterde groenten.',
                'prep_time' => 50,
                'instructions' => ['Verwarm de oven.', 'Kruid de kip en aardappelen.', 'Rooster alles gaar.', 'Serveer met de groenten.'],
                'categories' => ['Diner', 'Eiwitrijk'],
                'ingredients' => ['Kipfilet' => '400 g', 'Aardappel' => '600 g', 'Paprika' => '1 stuk', 'Ui' => '1 stuk', 'Olijfolie' => '3 el'],
                'image_path' => 'recipes/TKhKYptS0PmG5H5hFBi4nGpZhWucbkg0dZ7vjN3Z.webp',
            ],
            [
                'name' => 'Luchtige pannenkoeken',
                'description' => 'Zachte pannenkoeken die heerlijk smaken met vers fruit of een beetje stroop.',
                'prep_time' => 25,
                'instructions' => ['Meng bloem, melk en eieren.', 'Laat het beslag rusten.', 'Bak dunne pannenkoeken.', 'Serveer warm.'],
                'categories' => ['Ontbijt', 'Nederlands'],
                'ingredients' => ['Bloem' => '250 g', 'Melk' => '500 ml', 'Eieren' => '2 stuks', 'Boter' => '30 g'],
                'image_path' => 'recipes/NyXOPLGBJ5m976zVJUqK3Ta7nR55JEXt1cO4rhuh.jpg',
            ],
            [
                'name' => 'Frisse tomatensalade',
                'description' => 'Een frisse salade met rijpe tomaten, ui en een eenvoudige dressing van olijfolie.',
                'prep_time' => 15,
                'instructions' => ['Snijd de tomaten en ui.', 'Meng de dressing.', 'Schep alles voorzichtig om.', 'Serveer direct.'],
                'categories' => ['Lunch', 'Gezond'],
                'ingredients' => ['Tomaat' => '500 g', 'Ui' => '1 stuk', 'Olijfolie' => '3 el'],
                'image_path' => 'recipes/NkPU0pN8dAWi0aOkawAbDqTLF885BaW37dur9QUG.jpg',
            ],
            [
                'name' => 'Zachte chocoladetaart',
                'description' => 'Een rijke chocoladetaart met een zachte binnenkant en een volle, huiselijke smaak.',
                'prep_time' => 60,
                'instructions' => ['Verwarm de oven.', 'Smelt de chocolade met boter.', 'Meng de overige ingrediënten.', 'Bak de taart gaar en laat afkoelen.'],
                'categories' => ['Dessert'],
                'ingredients' => ['Bloem' => '200 g', 'Eieren' => '3 stuks', 'Boter' => '150 g', 'Melk' => '100 ml'],
                'image_path' => 'recipes/D2y3rRbRytqQESMz4sPZUhaGiolsDXM5PUZ1zVQ2.webp',
            ],
        ];
    }
}
