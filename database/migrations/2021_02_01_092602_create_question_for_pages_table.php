<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionForPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_for_pages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('page_id')->nullable();
            $table->text('question');
            $table->text('answer')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedBigInteger('member_id')->nullable();
            $table->timestamps();
            $table->foreign('page_id')->references('id')->on('footer_pages')->onUpdate('cascade') ->onDelete('cascade');
            $table->foreign('parent_id')->references('id')->on('question_for_pages')->onUpdate('cascade') ->onDelete('cascade');
            $table->foreign('member_id')->references('id')->on('member_ships')->onUpdate('cascade') ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('question_for_pages');
    }
}
