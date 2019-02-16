<?php

namespace Seeds;

use App\CardType;
use App\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        for ($i = 0; $i < 50; $i++) {
            DB::table('cards')->insert([
                'user_id' => User::inRandomOrder()->first()->id,
                'type_id' => CardType::inRandomOrder()->first()->id,
                'number' => $faker->numberBetween(100000000000, 9999999999999999),
            ]);
        }
    }
}
