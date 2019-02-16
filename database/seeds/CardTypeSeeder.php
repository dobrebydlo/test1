<?php
namespace Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CardTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (['temporary', 'basic'] as $type) {
            DB::table('card_types')->insert([
                'name' => $type,
            ]);
        }
        //
    }
}
