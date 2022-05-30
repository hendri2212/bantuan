<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Disaster;

class DisasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        for ($i=0; $i < 5; $i++) { 
            $insert = new Disaster;
            $insert->disaster_name  = $faker->company();
            $insert->information    = $faker->text(100);
            $insert->date           = $faker->dateTime();
            $insert->location       = $faker->city();
            $insert->admin_id       = 1;
            $insert->save();
        }
    }
}
