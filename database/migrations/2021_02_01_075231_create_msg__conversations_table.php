<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMsgConversationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('msg__conversations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sender');
            $table->unsignedBigInteger('reciever');
            $table->unsignedBigInteger('conv_id');
            $table->text('msg_content');
            $table->timestamps();
            $table->foreign('sender')->references('id')->on('users')->onUpdate('cascade') ->onDelete('cascade');
            $table->foreign('reciever')->references('id')->on('users')->onUpdate('cascade') ->onDelete('cascade');
            $table->foreign('conv_id')->references('id')->on('conversations')->onUpdate('cascade') ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('msg__conversations');
    }
}
