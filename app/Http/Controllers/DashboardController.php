<?php

namespace App\Http\Controllers;

use App\Fdr;
use App\FdrTransaction;
use App\Loan;
use App\Saving;
use App\SavingTransaction;
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
        $daily_saving_transactions = SavingTransaction::with('user','receiver','savings')->where(function ($q) use ($daily_savings){
            $q->whereIn('saving_id',$daily_savings);
        })->where('type','deposit')->get();


        $short_savings = Saving::where('type','short')->get('id');
        $short_saving_transactions = SavingTransaction::with('user','receiver','savings')->where(function ($q) use ($short_savings){
            $q->whereIn('saving_id',$short_savings);
        })->where('type','deposit')->get();


        $long_savings = Saving::where('type','long')->get('id');
        $long_saving_transactions = SavingTransaction::with('user','receiver','savings')->where(function ($q) use ($long_savings){
            $q->whereIn('saving_id',$long_savings);
        })->where('type','deposit')->get();

        $fdr_list = Fdr::get('id');
        $fdr_transactions = FdrTransaction::with('user')->where(function ($q) use ($fdr_list){
            $q->whereIn('fdr_id',$fdr_list);
        })->where('type','deposit')->get();

        $loan = Loan::whereIn('status',['active','closed'])->get();

        $monthly_data = DB::table('transaction')
        ->select(DB::raw("sum(case when `type`='income' then amount*1 else amount*0 end) as `income`"),DB::raw("sum(case when `type`='expense' then amount*1 else amount*0 end) as `expense`"), DB::raw('MONTH(created_at) as month'))
        ->groupby('month')
        ->where('status','approved')
        ->orderBy('created_at','ASC')
        ->get();

        $pie_chart_data = DB::table('transaction')
        ->select(DB::raw("sum(case when `type`='income' then amount*1 else amount*0 end) as `income`"),DB::raw("sum(case when `type`='expense' then amount*1 else amount*0 end) as `expense`"))
        ->where('status','approved')
        ->first();

        return view('admin/dashboard',compact('members','daily_saving_transactions','daily_savings','short_savings',
        'short_saving_transactions','long_savings','long_saving_transactions','fdr_list','fdr_transactions',
        'loan','monthly_data','pie_chart_data'));
    }

}
