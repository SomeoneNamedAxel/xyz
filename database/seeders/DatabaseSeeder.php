<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Code;
use App\Models\Track;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Categories
        $this->call(CategorySeeder::class);

        // Create weeks
        $this->call(WeekSeeder::class);

//        // Create content
//        User::factory()
//            ->count(15)
//            ->has(
//                Track::factory(config('app.tracks_per_week'))
//                    ->state(new Sequence(fn () => ['week_id' => rand(2, 7)]))
//                    ->sample()
//            )
//            ->has(Code::factory(config('app.codes_count')))
//            ->sequence(function (Sequence $sequence) {
//                $id = str_pad($sequence->index + 1, 4, "0", STR_PAD_LEFT);
//
//                return ['email' => "user{$id}@example.com"];
//            })
//            ->create();
        User::factory()
            ->count(15)
            ->sequence(function (Sequence $sequence) {
                // Crée un email unique en utilisant l'index de la séquence
                $id = str_pad($sequence->index + 1, 4, "0", STR_PAD_LEFT);
                $email = "user{$id}@example.com";

                // Vérifie si l'email existe déjà, sinon crée un nouvel utilisateur
                return [
                    'email' => $email,
                    'password' => bcrypt('password'), // Assure-toi d'avoir un mot de passe
                ];
            })
            ->create();



    }


}
