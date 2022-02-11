<?php

use Illuminate\Database\Seeder;
use App\Models\Sponsor;

class SponsorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sponsors = [
            [
                'package' => '24 hours sponsorship',
                'price' => '2.99',
                'period' => '24'
            ],
            [
                'package' => '72 hours sponsorship',
                'price' => '5.99',
                'period' => '72'
            ],
            [
                'package' => '144 hours sponsorship',
                'price' => '9.99',
                'period' => '144'
            ]
        ];
        foreach ($sponsors as $sponsor) {
            $new_sponsor = new Sponsor();
            $new_sponsor->package = $sponsor['package'];
            $new_sponsor->price = $sponsor['price'];
            $new_sponsor->period = $sponsor['period'];
            $new_sponsor->save();
        }
    }
}
