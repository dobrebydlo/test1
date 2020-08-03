<?php

namespace Seeds;

use App\Address;
use App\Phone;
use App\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * Class UserSeeder
 * @package Seeds
 */
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        User::query()->firstOrCreate(
            [
                'type' => 'admin',
                'email' => 'admin@admin.com',
            ],
            [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email_verified_at' => now(),
                'password' => Hash::make('admin'),
            ]
        );

        for ($i = 0; $i < 200; $i++) {
            $user = User::query()->firstOrCreate(
                [
                    'first_name' => $faker->firstName,
                    'last_name' => $faker->lastName,
                    'email' => $faker->unique()->safeEmail,
                    'email_verified_at' => now(),
                    'password' => Hash::make('password'),
                    'remember_token' => Str::random(10),
                ]
            );

            if ($user instanceof User) {
                $user->addresses()->attach(Address::query()->inRandomOrder()->first()->id);
                $user->phones()->attach(Phone::query()->inRandomOrder()->first()->id);
            }
        }
    }
}
