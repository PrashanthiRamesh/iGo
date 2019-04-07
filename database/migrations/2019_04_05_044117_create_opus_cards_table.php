<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpusCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opus_cards', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('number');
            $table->string('email');
            $table->date('expiry_date');
            $table->boolean('linked_with_igo');
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
        Schema::dropIfExists('opus_cards');
    }
}
