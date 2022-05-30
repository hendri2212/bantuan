<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Victim;

class VictimSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        for ($i=0; $i < 15; $i++) { 
            $insert = new Victim;
            $insert->name       = $faker->name();
            $insert->gender     = $faker->gender('male'|'female');
            $insert->age        = $faker->name();
            $insert->address    = $faker->address();
            $insert->disaster_id= $faker->numberBetween($min = 1, $max = 5);
            $insert->save();
        }
    }
}
