<?php

use Illuminate\Database\Seeder;

/**
 * Class DatabaseSeeder
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(\Seeds\AddressSeeder::class);
        $this->call(\Seeds\PhoneSeeder::class);
        $this->call(\Seeds\UserSeeder::class);
        $this->call(\Seeds\CardTypeSeeder::class);
        $this->call(\Seeds\CardSeeder::class);
        $this->call(\Seeds\ItemSeeder::class);
        $this->call(\Seeds\PurchaseSeeder::class);
    }
}
