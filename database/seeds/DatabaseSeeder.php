<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        factory(App\Hotel::class, 20)->create();
        factory(App\Vehicle::class, 20)->create();
        $this->call(CustomerVisaTypeSeeder::class);
    }
}
