<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostInfractionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_infractions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('comment_id')->nullable;
            $table->unsignedBigInteger('post_id');
            $table->unsignedBigInteger('type_id');
            $table->text('notes')->nullable();
            $table->tinyInteger('status')->nullable()->default(0);
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade') ->onDelete('cascade');
            $table->foreign('comment_id')->references('id')->on('Comment')->onUpdate('cascade') ->onDelete('cascade');
            $table->foreign('post_id')->references('id')->on('posts')->onUpdate('cascade') ->onDelete('cascade');
            $table->foreign('type_id')->references('id')->on('infractions')->onUpdate('cascade') ->onDelete('cascade');

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
        Schema::dropIfExists('post_infractions');
    }
}
