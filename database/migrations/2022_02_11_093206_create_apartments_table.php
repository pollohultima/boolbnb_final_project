<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->tinyInteger('rooms');
            $table->tinyInteger('bathrooms');
            $table->tinyInteger('beds');
            $table->smallInteger('squared_meters');
            $table->string('address');
            $table->string('latitude')->default(0);
            $table->string('longitude')->default(0);
            $table->string('image');
            $table->boolean('is_visible')->default(true);
            $table->tinyInteger('floor')->nullable();
            $table->smallInteger('price')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apartments');
    }
}
