<?php

namespace Seeds;

use App\CardType;
use App\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class CardSeeder
 * @package Seeds
 */
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

        for ($i = 0; $i < 500; $i++) {
            DB::table('cards')->insert(
                [
                    'user_id' => boolval(mt_rand(0, 1)) ? User::query()->inRandomOrder()->first()->id : null,
                    'type_id' => CardType::query()->inRandomOrder()->first()->id,
                    'number' => $faker->numberBetween(1000000000000000, 9999999999999999),
                ]
            );
        }
    }
}
