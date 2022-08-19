<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PostMeta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_meta', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->unsignedBigInteger('post_id');
            $table->unsignedBigInteger('language_id');
            $table->unsignedBigInteger('config_detail_field_id');
            $table->foreign('config_detail_field_id')
            ->references('id')->on('config_detail_field')->onDelete('cascade');
            $table->foreign('post_id')
                ->references('id')->on('post')->onDelete('cascade');
            $table->foreign('language_id')
                ->references('id')->on('languages');
            $table->string('meta_key');
            $table->longText('meta_value')->nullable();
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
        Schema::dropIfExists('post_meta');
    }
}
