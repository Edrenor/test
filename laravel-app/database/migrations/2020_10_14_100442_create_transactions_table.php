<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions',
            function (Blueprint $table) {
                $table->increments('id');
                $table->string('type', 30);
                $table->unsignedInteger('user_id');
                $table->unsignedInteger('wallet_id');
                $table->unsignedInteger('deposit_id');
                $table->double('amount', 10, 2);

                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('wallet_id')->references('id')->on('wallets')->onDelete('cascade');
                $table->foreign('deposit_id')->references('id')->on('deposits')->onDelete('cascade');

                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
