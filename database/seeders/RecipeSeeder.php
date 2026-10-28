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
        $users = User::query()
            ->whereIn('email', [
                'admin@dishdelights.test',
                'sophie@dishdelights.test',
            ])
            ->get()
            ->keyBy('email');
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
                    'user_id' => $users[$recipeData['user_email'] ?? 'admin@dishdelights.test']->id,
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

        Recipe::factory()
            ->count(2)
            ->create();

        Recipe::factory()
            ->create([
                'status' => 'rejected'
            ]);
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
                'image_path' => 'recipes/iMrKZnrcy5BsqJ4Q9Nfkqj5hgr5YwE1qOwjj7B5D.jpg',
            ],
            [
                'name' => 'Krokante groentebowl',
                'description' => 'Een kleurrijke bowl met rijst, geroosterde groenten en knapperige kikkererwten.',
                'prep_time' => 40,
                'instructions' => ['Kook de rijst.', 'Rooster de groenten en kikkererwten.', 'Verdeel alles over kommen.', 'Werk af met olijfolie.'],
                'categories' => ['Lunch', 'Gezond', 'Italiaans'],
                'ingredients' => ['Rijst' => '250 g', 'Paprika' => '2 stuks', 'Wortel' => '2 stuks', 'Kikkererwten' => '1 blik', 'Olijfolie' => '2 el'],
                'image_path' => 'recipes/RkmW3EdPvelMebcJDJbDBiu2odZunSwFVVdmsgXH.jpg',
            ],
            [
                'name' => 'Hartige kip met aardappelen',
                'description' => 'Malse kipfilet uit de oven met kruidige aardappelen en geroosterde groenten.',
                'prep_time' => 50,
                'instructions' => ['Verwarm de oven.', 'Kruid de kip en aardappelen.', 'Rooster alles gaar.', 'Serveer met de groenten.'],
                'categories' => ['Diner', 'Eiwitrijk'],
                'ingredients' => ['Kipfilet' => '400 g', 'Aardappel' => '600 g', 'Paprika' => '1 stuk', 'Ui' => '1 stuk', 'Olijfolie' => '3 el'],
                'image_path' => 'recipes/gtrNSN1BwDiC8pMI3QbgeNkk0rsSBZ3FwDBkoowx.avif',
            ],
            [
                'name' => 'Luchtige pannenkoeken',
                'description' => 'Zachte pannenkoeken die heerlijk smaken met vers fruit of een beetje stroop.',
                'prep_time' => 25,
                'instructions' => ['Meng bloem, melk en eieren.', 'Laat het beslag rusten.', 'Bak dunne pannenkoeken.', 'Serveer warm.'],
                'categories' => ['Ontbijt', 'Nederlands'],
                'ingredients' => ['Bloem' => '250 g', 'Melk' => '500 ml', 'Eieren' => '2 stuks', 'Boter' => '30 g'],
                'image_path' => 'recipes/faDw4xn6fc08FHRDu7DQFKh6SP1HYmxoTA5hmJ8y.jpg',
            ],
            [
                'name' => 'Frisse tomatensalade',
                'description' => 'Een frisse salade met rijpe tomaten, ui en een eenvoudige dressing van olijfolie.',
                'prep_time' => 15,
                'instructions' => ['Snijd de tomaten en ui.', 'Meng de dressing.', 'Schep alles voorzichtig om.', 'Serveer direct.'],
                'categories' => ['Lunch', 'Gezond'],
                'ingredients' => ['Tomaat' => '500 g', 'Ui' => '1 stuk', 'Olijfolie' => '3 el'],
                'image_path' => 'recipes/yt9jcTO9Q59MLhmZUdGUNGYJTwDlkRd4Mm9bkC8S.jpg',
            ],
            [
                'name' => 'Zachte chocoladetaart',
                'description' => 'Een rijke chocoladetaart met een zachte binnenkant en een volle, huiselijke smaak.',
                'prep_time' => 60,
                'instructions' => ['Verwarm de oven.', 'Smelt de chocolade met boter.', 'Meng de overige ingrediënten.', 'Bak de taart gaar en laat afkoelen.'],
                'categories' => ['Dessert'],
                'ingredients' => ['Bloem' => '200 g', 'Eieren' => '3 stuks', 'Boter' => '150 g', 'Melk' => '100 ml'],
                'image_path' => 'recipes/0M0V3S6mNSjtMxmpnQKvDjolj5mSqjLCkjjC6mF6.jpg',
            ],
            [
                'name' => 'Romige kippenpasta met broccoli',
                'description' => 'Een romige pasta met malse kip, broccoli en Parmezaanse kaas voor een heerlijke doordeweekse maaltijd.',
                'prep_time' => 35,
                'instructions' => ['Kook de pasta beetgaar.', 'Bak de kip gaar.', 'Kook de broccoli kort.', 'Maak de romige saus en meng alles met de Parmezaanse kaas.'],
                'categories' => ['Diner', 'Italiaans'],
                'ingredients' => ['Pasta' => '300 g', 'Kipfilet' => '350 g', 'Broccoli' => '1 stronk', 'Melk' => '200 ml', 'Parmezaanse kaas' => '50 g', 'Olijfolie' => '2 el'],
                'image_path' => 'recipes/4dwVXCWtl9dmf2TAQeDSVkyE6jnkOxOR2wvjCAvT.webp',
                'user_email' => 'sophie@dishdelights.test',
            ],
            [
                'name' => 'Gebakken zalm met citroen',
                'description' => 'Een eenvoudig en smaakvol gerecht met gebakken zalm, frisse citroen en een krokante kruidenkorst.',
                'prep_time' => 30,
                'instructions' => ['Verwarm de oven.', 'Leg de zalm in een ovenschaal.', 'Besprenkel met olijfolie en citroensap.', 'Bak de zalm gaar en serveer direct.'],
                'categories' => ['Diner', 'Eiwitrijk', 'Gezond'],
                'ingredients' => ['Zalm' => '2 filets', 'Citroen' => '1 stuk', 'Olijfolie' => '1 el', 'Broccoli' => '1 stronk', 'Aardappel' => '500 g'],
                'image_path' => 'recipes/7smFzgNCGBOtQ7YHycYrjp5njB46T7mCgIjjEwEa.jpg',
                'user_email' => 'sophie@dishdelights.test',
            ],
        ];
    }
}
