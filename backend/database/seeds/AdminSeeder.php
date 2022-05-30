<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        // for ($i=0; $i < 1; $i++) { 
            $insert = new Admin;
            $insert->name       = $faker->name();
            $insert->username   = 'admin';
            $insert->password   = 'admin';
            $insert->role       = 'admin';
            $insert->save();
        // }
    }
}
