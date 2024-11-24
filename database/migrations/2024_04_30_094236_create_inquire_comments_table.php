<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInquireCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inquire_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('inquire_id');
            $table->longText('comment');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade') ->onDelete('cascade');
            $table->foreign('inquire_id')->references('id')->on('inquiries')->onUpdate('cascade') ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inquire_comments');
    }
}
