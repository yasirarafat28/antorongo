<?php

namespace App\Http\Controllers;

use App\Fdr;
use App\FdrTransaction;
use App\Loan;
use App\Saving;
use App\SavingTransaction;
use App\Transaction;
use Auth;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //

    public function admin()
    {
        $members = User::where('role','member')->orderBy('id','DESC')->get();



        $daily_savings = Saving::where('type','daily')->get('id');
        $daily_saving_transactions = Transaction::with('user','receiver')->where('transaction_for','saving')->where(function ($q) use ($daily_savings){
            $q->whereIn('transactable_id',$daily_savings);
        })->where('flag','deposit')->sum('amount');


        $short_savings = Saving::where('type','short')->get('id');
        $short_saving_transactions = Transaction::with('user','receiver')->where('transaction_for','saving')->where(function ($q) use ($short_savings){
            $q->whereIn('transactable_id',$short_savings);
        })->where('flag','deposit')->sum('amount');


        $long_savings = Saving::where('type','long')->get('id');
        $long_saving_transactions = Transaction::with('user','receiver')->where('transaction_for','saving')->where(function ($q) use ($long_savings){
            $q->whereIn('transactable_id',$long_savings);
        })->where('flag','deposit')->sum('amount');

        $current_savings = Saving::where('type','current')->get('id');
        $current_saving_transactions = Transaction::with('user','receiver')->where('transaction_for','saving')->where(function ($q) use ($current_savings){
            $q->whereIn('transactable_id',$current_savings);
        })->where('flag','deposit')->sum('amount');

        $fdr_list = Fdr::get('id');
        $fdr_transactions = Transaction::with('user','receiver')->where('transaction_for','fdr')->where(function ($q) use ($fdr_list){
            $q->whereIn('transactable_id',$fdr_list);
        })->where('flag','deposit')->sum('amount');

        $loan = Loan::whereIn('status',['active','closed'])->get();
        $active_count   = Loan::where('status','active')->count();
        $pending_count   = Loan::where('status','pending')->count();
        $declined_count   = Loan::where('status','declined')->count();
        $closed_count   = Loan::where('status','closed')->count();

        $monthly_data = DB::table('transaction')
        ->select(DB::raw("sum(case when `type`='income' then amount*1 else amount*0 end) as `income`"),DB::raw("sum(case when `type`='expense' then amount*1 else amount*0 end) as `expense`"), DB::raw('MONTH(created_at) as month'), DB::raw('YEAR(created_at) as year'))
        ->groupby('month','year')
        ->where('status','approved')
        ->where('canculatable','yes')
        ->orderBy('created_at','ASC')
        ->get();

        $pie_chart_data = DB::table('transaction')
        ->select(DB::raw("sum(case when `type`='income' then amount*1 else amount*0 end) as `income`"),DB::raw("sum(case when `type`='expense' then amount*1 else amount*0 end) as `expense`"))
        ->where('status','approved')
        ->where('canculatable','yes')
        ->first();

        return view('admin/dashboard',compact('members','daily_saving_transactions','daily_savings','short_savings',
        'short_saving_transactions','long_savings','long_saving_transactions','fdr_list','fdr_transactions',
        'loan','active_count','pending_count','declined_count','closed_count','monthly_data','pie_chart_data','current_savings','current_saving_transactions'));
    }

}
