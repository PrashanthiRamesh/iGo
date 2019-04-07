<?php

use Illuminate\Database\Seeder;
use App\OpusCard;

class OpusCardTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      OpusCard::truncate();

        $faker = \Faker\Factory::create();

        // And now, let's create a few articles in our database:
        for ($i = 0; $i < 50; $i++) {
            OpusCard::create([
                'number' => $faker->numberBetween(1000000000,2147483647),
                'expiry_date'=>$faker->creditCardExpirationDate,
                'email'=>$faker->unique()->email,
                'linked_with_igo'=>false
            ]);
        }
    }
}
