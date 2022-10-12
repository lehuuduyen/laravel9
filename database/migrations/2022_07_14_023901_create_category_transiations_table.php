<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryTransiationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_transiations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('language_id');
            $table->foreign('category_id')
                ->references('id')->on('category')->onDelete('cascade');
            $table->foreign('language_id')
                ->references('id')->on('languages')->onDelete('cascade');

            $table->string('title')->nullable();
            $table->string('sub_title')->nullable();
            $table->string('excerpt')->nullable();
            $table->longText('description')->nullable();
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
        Schema::dropIfExists('category_transiations');
    }
}
