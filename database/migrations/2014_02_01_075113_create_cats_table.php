<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cats', function (Blueprint $table) {
            $table->id();
            $table->string('name_en');
            $table->string('name_ar');
            $table->text('photo')->nullable();
            $table->text('icon')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->integer('sort')->nullable();
            $table->integer('show')->nullable();
            $table->tinyInteger('is_year')->nullable()->default(0)->comment('0->not has model year,1 has model year');
            $table->tinyInteger('type')->comment('0->other,1->car,2->car services')->default(0)->nullable();
            $table->timestamps();
            $table->foreign('parent_id')->references('id')->on('cats')->onUpdate('cascade') ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cats');
    }
}
