<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comics', function (Blueprint $table) 
		{
            $table->id();
            $table->string('title');
            $table->string('volume')->nullable();
			$table->string('volume_id');
            $table->string('issue_num');
            $table->string('pub_date');
			$table->string('condition');
			$table->string('writer_name');
			$table->string('artist_name');
            $table->string('description')->nullable();
            $table->string('image_URL');
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
        Schema::dropIfExists('comics');
    }
}
