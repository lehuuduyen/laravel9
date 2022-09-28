<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PageTransiations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_transiations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('page_id');
            $table->unsignedBigInteger('language_id');
            $table->foreign('page_id')
                ->references('id')->on('page')->onDelete('cascade');
            $table->foreign('language_id')
                ->references('id')->on('languages')->onDelete('cascade');

            $table->string('title');
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
        Schema::dropIfExists('page_transiations');
    }
}
