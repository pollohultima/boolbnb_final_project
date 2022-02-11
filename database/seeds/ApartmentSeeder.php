<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Apartment;
use Illuminate\Support\Str;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        //
        for ($i=0; $i < 20; $i++) { 
            # code...
            $apartment = new Apartment();

            $apartment->title = $faker->sentence(5);
            $apartment->slug = Str::slug($apartment->title);
            $apartment->rooms = $faker->randomDigit(1, 9);
            $apartment->bathrooms = $faker->randomDigit(1, 4);
            $apartment->beds = $faker->randomDigit(1, 15);
            $apartment->squared_meters = $faker->randomDigit(50, 1000);
            $apartment->address = $faker->address();
            $apartment->longitude = $faker->longitude($min = -180, $max = 180);
            $apartment->latitude = $faker->latitude($min = -90, $max = 90);
            $apartment->image = $faker->imageUrl(800, 800);
            $apartment->is_visible = true;
            $apartment->floor = $faker->randomDigit(0, 9);
            $apartment->price = $faker->randomNumber(120, 2300);
            $apartment->description = $faker->paragraphs(4, true);
            $apartment->save();
        }
    }
}
