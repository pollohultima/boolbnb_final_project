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
        $this->call(ServiceSeeder::class);
        $this->call(SponsorSeeder::class);
        $this->call(ViewSeeder::class);
        $this->call(ApartmentSeeder::class);
        $this->call(MessageSeeder::class);
    }
}