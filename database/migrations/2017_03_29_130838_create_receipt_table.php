<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceiptTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipt', function (Blueprint $table) {
            
            $table->increments('id');
            $table->integer('city_id');

            $table->string('name', 100);
            $table->string('email', 100);
            $table->string('phone', 20);
            $table->string('id_card', 50);
            $table->string('address');
            $table->string('store_name', 100);
            $table->string('contact_accept', 100);

            //$table->string('picture');
            $table->string('nominal', 100);

            // $table->string('unique_code', 255);

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
        Schema::dropIfExists('receipt');
    }
}
