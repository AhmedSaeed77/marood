<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('avatar')->nullable();
            $table->string('cover')->nullable();
            $table->string('fb')->nullable();
            $table->string('tw')->nullable();
            $table->string('inst')->nullable();
            $table->unsignedBigInteger('area_id')->nullable();
            $table->unsignedBigInteger('member_id')->nullable();
            $table->integer('commession')->nullable();
            $table->smallInteger('active')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('firebaseToken')->nullable();
            $table->string('playerToken')->nullable();
            $table->string('QR')->nullable();
            $table->string('store_identify')->nullable();
            $table->timestamps();
            $table->foreign('area_id')->references('id')->on('areas')->onUpdate('cascade') ->onDelete('cascade');
            $table->foreign('member_id')->references('id')->on('member_ships')->onUpdate('cascade') ->onDelete('cascade');
            // $table->foreign('role_id')->references('id')->on('roles')->onUpdate('cascade') ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
