<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuesItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menues_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cat_id');
            $table->unsignedBigInteger('menues_id');
            $table->string('show_name_ar');
            $table->string('show_name_en');
            $table->tinyInteger('is')->comment('1->is_name,2->is_logo,3->name_logo');
            $table->integer('sort')->nullable();
            $table->tinyInteger('img_filter')->nullable()->default(0)->comment('0->not has filter,1->has filter');
       
            $table->timestamps();
            $table->foreign('cat_id')->references('id')->on('cats')->onUpdate('cascade') ->onDelete('cascade');
            $table->foreign('menues_id')->references('id')->on('menues')->onUpdate('cascade') ->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menues_items');
    }
}
