<?php

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = ['WiFi', 'Posto Macchina', 'Piscina', 'Portineria', 'Sauna', 'Vista Mare'];
        foreach ($services as $service) {
            $ser = new Service();
            $ser->name = $service;
            $ser->slug = Str::slug($ser->name);
            $ser->save();
        }
    }
}