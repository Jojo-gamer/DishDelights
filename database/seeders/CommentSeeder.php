<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::query()->whereIn('email', [
            'sophie@dishdelights.test',
            'lucas@dishdelights.test',
        ])->get()->keyBy('email');

        foreach ([
            ['Romige tomatenpasta', 'sophie@dishdelights.test', 'Heerlijk recept', 'De saus was romig en de pasta stond snel op tafel.', 10],
            ['Romige tomatenpasta', 'lucas@dishdelights.test', 'Voor herhaling vatbaar', 'Ik heb extra knoflook toegevoegd en dat was erg lekker.', 9],
            ['Krokante groentebowl', 'sophie@dishdelights.test', 'Fris en vullend', 'De combinatie van groenten en kikkererwten werkt goed.', 9],
            ['Luchtige pannenkoeken', 'lucas@dishdelights.test', 'Goede basis', 'De pannenkoeken werden mooi luchtig.', 8],
            ['Zachte chocoladetaart', 'sophie@dishdelights.test', 'Perfecte verhouding!', 'Deze chocolade taart was echt geweldig! Niet te droog, niet te zoet, hij was perfect! Bedankt voor dit recept!', 10],
        ] as [$recipeName, $email, $title, $content, $rating]) {
            Comment::create([
                'recipe_id' => Recipe::where('name', $recipeName)->value('id'),
                'user_id' => $users[$email]->id,
                'title' => $title,
                'content' => $content,
                'rating' => $rating,
            ]);
        }
    }
}
