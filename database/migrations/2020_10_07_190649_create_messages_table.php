<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->enum('type',['p2p','group'])->default('p2p');
            $table->integer('sender_id')->unsigned()->default(0);
            $table->integer('receiver_id')->unsigned()->default(0);
            $table->integer('group_id')->unsigned()->default(0);
            $table->text('message');
            $table->enum('status',['delivered','read'])->default('delivered');
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
        Schema::dropIfExists('messages');
    }
}
