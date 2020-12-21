<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhotosTable extends Migration
{
    public function up()
    {
        $this->down();
        Schema::create('photos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('location');
            $table->string('story');
            $table->dateTime('date');
            $table->string('photo_url');

            $table->foreignId('user_id');
            $table->foreignId('category_id');
        });
    }
 function down()
    {
        Schema::dropIfExists('photos');
    }
}
