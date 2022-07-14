<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CategoryConfigField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_config_field', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('config_field_id');
            $table->foreign('category_id')
              ->references('id')->on('category')->onDelete('cascade');
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
        Schema::dropIfExists('category_config_field');
    }
}
