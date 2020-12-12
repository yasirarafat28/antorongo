<?php

use App\NumberConverter;
use App\Saving;
use App\SavingTransaction;
use App\Transaction;
use App\TransactionHead;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SynchronizeSavingData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tranasctions = SavingTransaction::get();
        foreach($tranasctions??array() as $row){

            $saving = Saving::find($row->saving_id);

            if(!$saving){
                continue;
            }
            if($row->type=='deposit'){
                if($saving->type=='long'){
                    $flag = 'saving_project_10_income';
                }elseif($saving->type=='long'){
                    $flag = 'saving_project_5_income';
                }elseif($saving->type=='current'){
                    $flag = 'general_saving_income';
                }else{
                    $flag = 'daily_saving_collection_income';
                }
                $head = TransactionHead::where('slug',$flag)->first();
                $head_id = $head->id??0;

            }elseif($row->type=='withdraw'){
                if($saving->type=='long'){
                    $flag = 'saving_project_10_expense';
                }elseif($saving->type=='long'){
                    $flag = 'saving_project_5_expense';
                }elseif($saving->type=='current'){
                    $flag = 'general_saving_refund_expense';
                }else{
                    $flag = 'daily_saving_expense';
                }
                $head = TransactionHead::where('slug',$flag)->first();
                $head_id = $head->id??0;

            }else{
                $head_id=0;
            }



            $transaction = new Transaction();
            $transaction->txn_id = $row->txn_id;
            $transaction->transaction_for = 'saving';
            $transaction->transactable_id = $row->saving_id;
            $transaction->flag = $row->type;
            if($row->type=='withdraw'){
                $transaction->type = 'expense';
            }else{
                $transaction->type = 'income';
            }
            $transaction->head_id = $head_id;
            $transaction->user_id = $row->user_id;
            $transaction->note = $row->note;
            $transaction->date = $row->date;
            $transaction->amount = $row->amount;
            $transaction->added_by = $row->received_by;
            $transaction->received_by = $row->received_by;
            $transaction->admin_status ='approved';
            $transaction->manager_status = 'approved';
            $transaction->status = 'approved';
            if($row->type=='deposit' || $row->type=='withdraw'){
                $transaction->canculatable='yes';
            }else{
                $transaction->canculatable='no';
            }
            $transaction->save();

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
