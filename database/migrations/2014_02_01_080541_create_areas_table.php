<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('areas', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar',255);
            $table->string('name_en',255);
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->integer('lat')->nullable();
            $table->integer('lng')->nullable();
            $table->timestamps();
            $table->foreign('parent_id')->references('id')->on('areas')->onUpdate('cascade') ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('areas');
    }
}
