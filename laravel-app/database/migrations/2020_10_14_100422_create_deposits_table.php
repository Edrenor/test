<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepositsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposits',
            function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('user_id');
                $table->unsignedInteger('wallet_id');
                $table->double('invested', 10, 2);
                $table->double('percent', 10, 2);
                $table->smallInteger('active');
                $table->smallInteger('duration');
                $table->smallInteger('accrue_times');

                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('wallet_id')->references('id')->on('wallets')->onDelete('cascade');

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
        Schema::dropIfExists('deposits');
    }
}
