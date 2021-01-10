<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDatesInSavingTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('saving', function (Blueprint $table) {
            //

            $table->dateTime('closed_at')->nullable();
            $table->dateTime('approved_at')->nullable();
            $table->dateTime('declined_at')->nullable();
        });
        Schema::table('loan', function (Blueprint $table) {
            //


            $table->dateTime('approved_at')->nullable();
            $table->dateTime('declined_at')->nullable();
        });
        Schema::table('fdr', function (Blueprint $table) {
            //

            $table->dateTime('closed_at')->nullable();
            $table->dateTime('approved_at')->nullable();
            $table->dateTime('declined_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('saving', function (Blueprint $table) {
            //
        });
    }
}
