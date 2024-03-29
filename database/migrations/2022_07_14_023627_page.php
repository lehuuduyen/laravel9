<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Page extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string('slug')->unique();
            $table->tinyInteger('status')->default(2);
            $table->string('banner_pc')->nullable();
            $table->string('banner_sp')->nullable();
            $table->string('img_sp')->nullable();
            $table->string('img_pc')->nullable();
            $table->tinyInteger('is_category')->default(2);
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
        Schema::dropIfExists('page');
    }
}
