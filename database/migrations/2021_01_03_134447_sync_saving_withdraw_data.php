<?php

use App\SavingTransaction;
use App\Transaction;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SyncSavingWithdrawData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        $tranasctions = SavingTransaction::where('outgoing','>',0)->get();
        foreach($tranasctions as $tranasction){

            $row = Transaction::where('txn_id',$tranasction->txn_id)->first();
            if($row){
                $row->amount = $tranasction->outgoing;
                $row->save();
            }


        }
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
