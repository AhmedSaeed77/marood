<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommessionTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commession_transfers', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('phone');
            $table->integer('price');
            $table->unsignedBigInteger('bank_id')->nullable();
            $table->string('userBankName');
            $table->unsignedBigInteger('timeOfTransfer')->nullable();
            $table->unsignedBigInteger('post_number')->nullable();
            $table->unsignedBigInteger('package_id')->nullable();
            $table->text('notes');
            $table->text('receiptPhoto');   
            $table->tinyInteger('type')->comment('0->commission,1->membership');    
            $table->timestamps();
            $table->foreign('bank_id')->references('id')->on('haraj_banks')->onUpdate('cascade') ->onDelete('set null');
            $table->foreign('timeOfTransfer')->references('id')->on('transfer_dates')->onUpdate('cascade') ->onDelete('set null');
            $table->foreign('post_number')->references('id')->on('posts')->onUpdate('cascade') ->onDelete('cascade');
            $table->foreign('package_id')->references('id')->on('member_ships')->onUpdate('cascade') ->onDelete('no action');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commession_transfers');
    }
}
