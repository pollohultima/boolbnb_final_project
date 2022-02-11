<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Models\Message;


class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 10; $i++) {
            $msg = new Message();
            $msg->name = $faker->name();
            $msg->email = $faker->email();
            $msg->content = $faker->text(100);
            $msg->save();
        }
    }
}