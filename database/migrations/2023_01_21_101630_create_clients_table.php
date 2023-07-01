<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('added_from');
            $table->foreignId('produk_id');
            $table->foreignId('user_id');
            $table->string('fullname');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('address');
            $table->string('city');
            $table->string('province');
            $table->string('zip_code');
            $table->string('status')->default('Active');
            $table->date('exp_date')->nullable();
            $table->timestamps();

            $table->foreign('added_from')->references('id')->on('users');
            $table->foreign('produk_id')->references('id')->on('produks');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
