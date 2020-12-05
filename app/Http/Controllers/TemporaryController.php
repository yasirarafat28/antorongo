<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Crypt;
use App\Fdr;
use App\FdrTransaction;
use App\Loan;
use App\LoanTransaction;
use App\Saving;
use App\User;

class TemporaryController extends Controller
{
    //

    public function loan_transaction_to_transaction_table(){

        $l_transactions = LoanTransaction::get();
        foreach($l_transactions??array() as $l_transaction){

        }
    }

    public function DecryptTest()
    {
        //$val = decrypt(Auth::user()->getOriginal('password'),true);
        return Crypt::decryptString(Auth::user()->password);
        return $val;
    }


    public function UniqueIdTransparent(){

    	$fdr = Fdr::all();
    	foreach ($fdr as $key => $item) {
    		$temp = $item->txn_id;
    		$item->old_txn= $temp;
    		$item->txn_id= uniqid();
    		$item->save();
    	}
    	$loan = Loan::all();
    	foreach ($loan as $key => $item) {
    		$temp = $item->unique_id;
    		$item->old_txn= $temp;
    		$item->unique_id= uniqid();
    		$item->save();
    	}
    	$saving = Saving::all();
    	foreach ($saving as $key => $item) {
    		$temp = $item->txn_id;
    		$item->old_txn= $temp;
    		$item->txn_id= uniqid();
    		$item->save();
    	}

    }

    public function MemberFilter()
    {
    	$count = 0;
    	$users = User::all();
    	foreach ($users as $key => $user) {
    		$abc =  User::where('unique_id',$user->unique_id)->get();
    		if (sizeof($abc)<2) {
    			continue;
    		}
    		$duplicate_user = User::where('unique_id',$user->unique_id)->where('id','!=',$user->id)->get();

    		foreach ($duplicate_user as $sub_key => $sub_user) {

    			$loans = Loan::where('user_id',$sub_user->id)->get();
    			foreach ($loans as $key => $loan) {
    				$loan->user_id = $user->id;
    				$loan->save();
    			}
    			$savings = Saving::where('user_id',$sub_user->id)->get();
    			foreach ($savings as $key => $saving) {
    				$saving->user_id = $user->id;
    				$saving->save();
    			}
    			$fdrs = Fdr::where('user_id',$sub_user->id)->get();
    			foreach ($fdrs as $key => $fdr) {
    				$fdr->user_id = $user->id;
    				$fdr->save();
    			}

    			/*Loan::where('user_id',$sub_user->id)->update(['user_id'=>$user->id]);
    			Saving::where('user_id',$sub_user->id)->update(['user_id'=>$user->id]);
    			Fdr::where('user_id',$sub_user->id)->update(['user_id'=>$user->id]);*/

    			User::destroy($sub_user->id);

    			$count++;
    		}
    	}

    	return $count;
    }

    public function fdr_transaction_sync(){
        $records = Fdr::get();
        foreach($records as  $fdr){
            $prev_deposit = FdrTransaction::where('fdr_id',$fdr->id)->where('type','deposit')->sum('amount');
            $fdr->amount = $prev_deposit;
            $fdr->status = 'pending';
            $fdr->save();

        }
        return 'success';

    }
}
