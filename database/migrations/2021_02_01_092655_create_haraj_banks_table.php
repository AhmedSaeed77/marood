<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHarajBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('haraj_banks', function (Blueprint $table) {
            $table->id();
            $table->string('bankName');
            $table->string('accountnumber');
            $table->string('userNameBank');
            $table->string('Iban');
            $table->text('bank_photo');
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
        Schema::dropIfExists('haraj_banks');
    }
}
