<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $faker = Faker::create();

    	foreach (range(1,100) as $index) {
            $user = new User();
            $user->name = $faker->name;
            $user->email = $faker->email;
            $user->password = bcrypt('password');
            $user->save();
        }
    }
}
