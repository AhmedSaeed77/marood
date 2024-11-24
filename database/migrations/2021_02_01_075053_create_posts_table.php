<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title_ar');
            $table->string('title_en');
            $table->text('description');
            $table->unsignedBigInteger('cat_id');
            $table->unsignedBigInteger('area_id')->nullable();
            $table->unsignedBigInteger('bank_id')->nullable();
            $table->integer('lat')->nullable();
            $table->integer('lng')->nullable();
            $table->integer('price')->nullable();
            $table->integer('model')->nullable();
            $table->integer('km')->nullable();
            $table->tinyInteger('use_status')->nullable();
            $table->string('type')->nullable();
            $table->tinyInteger('active')->comment('0->not active,1->active');
            $table->tinyInteger('contact')->comment('1->contact is phone,2->contact is message mail');
            $table->tinyInteger('post_type')->comment('1=>sale,2->concession')->nullable();
            $table->tinyInteger('gear_type')->comment('0->normal,1->automatic')->nullable();
            $table->tinyInteger('fuel_type')->comment('0->petrol,1->hypered,2->dezil')->nullable();
            $table->tinyInteger('double')->comment('0->no,1->yes')->nullable();
            $table->string('mobile')->nullable();
            // $table->integer('post_number')->unique();
            $table->integer('commission')->nullable();
            $table->tinyInteger('is_pay')->nullable()->default(0)->comment('0->not pay commission,1->commission is payed');
            $table->integer('special_id')->nullable();
            $table->tinyInteger('comment')->default(1)->nullable();
            $table->tinyInteger('Show_on_map')->default(0)->nullable()->commnet('0->not show,1->show');
            $table->timestamps();
            $table->foreign('cat_id')->references('id')->on('cats')->onUpdate('cascade') ->onDelete('cascade');
            $table->foreign('area_id')->references('id')->on('areas')->onUpdate('cascade') ->onDelete('set null ');
            $table->foreign('bank_id')->references('id')->on('HarajBank')->onUpdate('cascade') ->onDelete('set null ');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
