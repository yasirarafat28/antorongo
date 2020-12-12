<?php

use App\Fdr;
use App\FdrTransaction;
use App\Transaction;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SyncronizeFdrTransactionData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $records = Fdr::get();
        foreach($records as  $fdr){
            $prev_deposit = FdrTransaction::where('fdr_id',$fdr->id)->where('type','deposit')->sum('amount');
            $fdr->amount = $prev_deposit;
            $fdr->status = 'pending';
            $fdr->save();

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
