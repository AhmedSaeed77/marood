<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVerifyModelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verify_model', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('ID_number');
            $table->string('name')->nullable();
            $table->string('documentNumber')->nullable();
            $table->string('photo')->nullable();
            $table->text('notes')->nullable();
            $table->tinyInteger('type')->comment('1->absher,2->documented');
            $table->tinyInteger('verify')->defaul(0)->comment('1->verified,0->not verified')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade') ->onDelete('cascade');
          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('verify_model');
    }
}
