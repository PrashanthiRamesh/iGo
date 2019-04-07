<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinkedOpusCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('linked_opus_cards', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->bigInteger('number');
            $table->string('email');
            $table->date('expiry_date');
            $table->string('account_email');
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
        Schema::dropIfExists('linked_opus_cards');
    }
}
