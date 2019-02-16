<?php
namespace Seeds;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
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

            $item = [
                'name' => rtrim($faker->sentence(mt_rand(1, 3)), '.'),
                'price' => $faker->numberBetween(10, 1000),
            ];

            DB::table('items')->insert($item);
        }
    }
}
