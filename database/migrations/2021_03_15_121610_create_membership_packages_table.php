<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembershipPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membership_packages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('member_id');
            $table->integer('number')->default(1)->nullable();
            $table->tinyInteger('duration')->nullable()->default(2)->comment('0->day,1->week,2->mounth,3->year');
            $table->string('title_ar');
            $table->string('title_en');
            $table->integer('price');

            $table->timestamps();
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
        Schema::dropIfExists('membership_packages');
    }
}
