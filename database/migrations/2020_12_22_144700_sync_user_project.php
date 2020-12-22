<?php

use App\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SyncUserProject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        User::where('unique_id','like','%FD%')
        ->update(['project'=>'fdr_member']);


        User::where('unique_id','like','%FM%')
        ->update(['project'=>'founding_member']);



        User::where('unique_id','like','%DS%')
        ->update(['project'=>'daily_saving']);

        User::where('project','saving_project')
        ->update(['project'=>'daily_saving']);



        User::where('project','saving')
        ->update(['project'=>'current_saving']);


        Schema::table('users', function (Blueprint $table) {
            $table->integer('parent_id')->default(0)->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
