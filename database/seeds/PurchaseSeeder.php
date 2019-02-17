<?php
namespace Seeds;

use App\Card;
use App\Item;
use App\Purchase;
use App\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

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

        for ($i = 0; $i < 2000; $i++) {

            $user = User::where('type', 'customer')->inRandomOrder()->first();

            if (boolval(mt_rand(0, 1))) {
                $card = $user->cards()->inRandomOrder()->first();
                $card_number = ($card instanceof Card) ? $card->number : null;
            }

            $purchase = Purchase::firstOrCreate([
                'user_id' => $user->id,
                'card_number' => isset($card_number) ? $card_number : null,
                'created_at' => $faker->dateTimeBetween('-3 months', 'now'),
            ]);

            if ($purchase instanceof Purchase) {

                $item_count = mt_rand(1, 5);
                Item::inRandomOrder()
                    ->take($item_count)
                    ->pluck('price', 'id')
                    ->each(function($price, $id) use (&$purchase) {

                        $attributes = [
                            'price' => $price,
                            'quantity' => mt_rand(1, 5),
                        ];

                        $purchase->items()->attach($id, $attributes);
                    })
                ;
            }
        }
    }
}
