<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFounderDepositsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('founder_deposits', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->default(0);
            $table->text('txn_id')->nullable();
            $table->text('note')->nullable();
            $table->dateTime('started_at')->nullable();
            $table->enum('status',['active','pending','closed'])->default('pending');

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
        Schema::dropIfExists('founder_deposits');
    }
}
