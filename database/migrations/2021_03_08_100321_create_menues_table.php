<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menues', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->tinyInteger('is')->comment('1->is_name,2->is_logo,3->name_logo,name_icon');
            $table->tinyInteger('h_v')->comment('1->horzintal,2->vertical');
            $table->tinyInteger('show')->nullable()->defual(1)->comment('0->not show,1->show');
           
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
        Schema::dropIfExists('menues');
    }
}
