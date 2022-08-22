<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PageConfigField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_config_field', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->unsignedBigInteger('page_id');
            $table->unsignedBigInteger('config_field_id');
            $table->foreign('page_id')
              ->references('id')->on('page')->onDelete('cascade');
              $table->foreign('config_field_id')
              ->references('id')->on('config_field')->onDelete('cascade');
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
        Schema::dropIfExists('page_config_field');
    }
}
