<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SavingTransaction;
use App\SavingPackage;
use App\NumberConverter;
use App\User;
use App\Saving;
use Auth;

class SavingTransactionController extends Controller
{
    //

    public function edit($id)
    {
    	$saving_transaction = SavingTransaction::find($id);
    	$saving = Saving::find($saving_transaction->saving_id);

    	$type = $saving->type;


        $packages = SavingPackage::where('type',$type)->get();
        $members = User::where('role','member')->orderBy('name','ASC')->get();



        $users_savings = Saving::with('user','package')->where('user_id',$saving->user_id)->get();
        return view('admin/saving/deposit-edit',compact('members','type','packages','saving_transaction','saving','users_savings'));
    }

    public function update(Request $request, $id)
    {


        $transaction = SavingTransaction::find($id);
        $transaction->saving_id = $request->saving_id;
        $transaction->user_id = $request->user_id;
        $transaction->received_by = Auth::user()->id;
        if ($transaction->type=='deposit'|| $transaction->type=='profit') {
        	$transaction->amount = NumberConverter::bn2en($request->amount);
        	# code...
        }else{
        	$transaction->outgoing = NumberConverter::bn2en($request->amount);

        }
        $transaction->date = $request->date;
        $transaction->status = 'approved';
        $transaction->manager_status = 'approved';
        $transaction->admin_status = 'approved';
        $transaction->save();
        return back()->withSuccess('সফলভাবে সেভ করা হয়েছে');

    }



    public function ManualProfit(Request $request)
    {
        $transaction = new SavingTransaction();
        $transaction->txn_id = uniqid();
        $transaction->saving_id = $request->saving_id;
        $transaction->user_id = $request->user_id;
        $transaction->received_by = Auth::user()->id;
        $transaction->type = 'profit';
        $transaction->amount = NumberConverter::bn2en($request->amount);
        $transaction->note = $request->note;
        $transaction->date = $request->date;
        $transaction->status = 'approved';
        $transaction->manager_status = 'approved';
        $transaction->admin_status = 'approved';
        $transaction->save();
//
//        if ($request->invoice)
//        {
//            $user = User::find($request->user_id);
//            $date =  $request->date;
//            $saving_amount = NumberConverter::bn2en($request->amount);
//            return view('admin/invoice',compact('user','saving_amount','date'));
//        }

        return back()->withSuccess('সফলভাবে সেভ করা হয়েছে');



    }

    public function destroy($id)
    {
    	SavingTransaction::destroy($id);

    	return back()->withSuccess('সফলভাবে মুছে ফেলা হয়েছে');
    }
}
