<?php

use App\Bank;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banks', function (Blueprint $table) {
            $table->id();
            $table->text('name')->nullable();
            $table->char('slug')->nullable();
            $table->enum('status',['active','inactive'])->default('active');
            $table->timestamps();
        });

        $row = new Bank();
        $row->name = 'যমুনা ব্যাংক';
        $row->slug = 'jamuna';
        $row->save();

        $row = new Bank();
        $row->name = 'শাহজালাল ব্যাংক';
        $row->slug = 'shah_jalal';
        $row->save();

        $row = new Bank();
        $row->name = 'মার্কেন্টাইল ব্যাংক';
        $row->slug = 'mercantile';
        $row->save();


        Schema::table('transaction', function (Blueprint $table) {
            $table->integer('bank_id')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banks');
    }
}
