<?php

namespace Seeds;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        for ($i = 0; $i < 200; $i++) {
            DB::table('addresses')->insert([
                'street' => $faker->address,
            ]);
        }
    }
}
