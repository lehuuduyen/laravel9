<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Category extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string('name');
            $table->string('img_sp')->nullable();
            $table->string('img_pc')->nullable();
            $table->tinyInteger('status')->default(2);
            $table->unsignedBigInteger('page_id');
            $table->foreign('page_id')
              ->references('id')->on('page')->onDelete('cascade');
            $table->string('slug');
            $table->bigInteger('parent_id')->nullable();


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
        Schema::dropIfExists('category');
    }
}
