<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ConfigDetailField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config_detail_field', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->unsignedBigInteger('config_field_id');
              $table->foreign('config_field_id')
              ->references('id')->on('config_field')->onDelete('cascade');

            $table->string('title');
            $table->string('key');
            $table->tinyInteger('type');
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
        Schema::dropIfExists('config_detail_field');
    }
}
