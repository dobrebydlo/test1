<?php
namespace Seeds;

use App\Card;
use App\Item;
use App\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PurchaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        for ($i = 0; $i < 5000; $i++) {

            $user = User::inRandomOrder()->first();

            if (boolval(mt_rand(0, 1))) {
                $card = $user->cards()->inRandomOrder()->first();
                $card_number = ($card instanceof Card) ? $card->number : null;
            }

            $item = Item::inRandomOrder()->first();

            DB::table('purchases')->insert([
                'user_id' => $user->id,
                'card_number' => isset($card_number) ? $card_number : null,
                'item_id' => $item->id,
                'price' => $item->price,
                'quantity' => mt_rand(1, 10),
                'created_at' => $faker->dateTimeBetween('-3 months', 'now'),
            ]);

        }
    }
}
