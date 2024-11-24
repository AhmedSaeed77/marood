<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->text('desc');
            $table->string('phone');
            $table->text('photo')->nullable();
            $table->unsignedBigInteger('why_id');
            $table->tinyInteger('status')->nullable()->default(0);
            $table->timestamps();
            $table->foreign('why_id')->references('id')->on('why_contacts')->onUpdate('cascade') ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
