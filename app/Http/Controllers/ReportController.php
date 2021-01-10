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
class ReportController extends Controller
{
    //


    public function report(Request $request){

        $members = User::where('role','member')->orderBy('id','DESC')->get();

        $daily_savings = Saving::where('type','daily')->get('id');
        $daily_saving_transactions = Transaction::with('user','receiver')->where('transaction_for','saving')->where(function ($q) use ($daily_savings){
            $q->whereIn('transactable_id',$daily_savings);
        })->where(function ($q) use ($request){
            if ($request->has('from') && $request->from) {
                $q->where(DB::raw('DATE(date)'),'>=',$request->from);

            }
            if ($request->has('to') && $request->to) {
                $q->where(DB::raw('DATE(date)'),'<=',$request->to);

            }

        })->where('flag','deposit')->sum('amount');


        $short_savings = Saving::where('type','short')->get('id');
        $short_saving_transactions = Transaction::with('user','receiver')->where('transaction_for','saving')->where(function ($q) use ($short_savings){
            $q->whereIn('transactable_id',$short_savings);
        })->where('flag','deposit')->where(function ($q) use ($request){
            if ($request->has('from') && $request->from) {
                $q->where(DB::raw('DATE(date)'),'>=',$request->from);

            }
            if ($request->has('to') && $request->to) {
                $q->where(DB::raw('DATE(date)'),'<=',$request->to);

            }

        })->sum('amount');


        $long_savings = Saving::where('type','long')->get('id');
        $long_saving_transactions = Transaction::with('user','receiver')->where('transaction_for','saving')->where(function ($q) use ($long_savings){
            $q->whereIn('transactable_id',$long_savings);
        })->where('flag','deposit')->sum('amount');

        $current_savings = Saving::where('type','current')->get('id');
        $current_saving_transactions = Transaction::with('user','receiver')->where('transaction_for','saving')->where(function ($q) use ($current_savings){
            $q->whereIn('transactable_id',$current_savings);
        })->where('flag','deposit')->where(function ($q) use ($request){
            if ($request->has('from') && $request->from) {
                $q->where(DB::raw('DATE(date)'),'>=',$request->from);

            }
            if ($request->has('to') && $request->to) {
                $q->where(DB::raw('DATE(date)'),'<=',$request->to);

            }

        })->sum('amount');

        $fdr_list = Fdr::get('id');
        $fdr_transactions = Transaction::with('user','receiver')->where('transaction_for','fdr')->where(function ($q) use ($fdr_list){
            $q->whereIn('transactable_id',$fdr_list);
        })->where('flag','deposit')->where(function ($q) use ($request){
            if ($request->has('from') && $request->from) {
                $q->where(DB::raw('DATE(date)'),'>=',$request->from);

            }
            if ($request->has('to') && $request->to) {
                $q->where(DB::raw('DATE(date)'),'<=',$request->to);

            }

        })->sum('amount');

        $short_active_count   = Saving::where('type','short')->where(function ($q) use ($request){
            if ($request->has('from') && $request->from) {
                $q->where(DB::raw('DATE(approved_at)'),'>=',$request->from);

            }
            if ($request->has('to') && $request->to) {
                $q->where(DB::raw('DATE(approved_at)'),'<=',$request->to);

            }

        })->where('status','approved')->count();
        $short_pending_count   = Saving::where('type','short')->where(function ($q) use ($request){
            if ($request->has('from') && $request->from) {
                $q->where(DB::raw('DATE(created_at)'),'>=',$request->from);

            }
            if ($request->has('to') && $request->to) {
                $q->where(DB::raw('DATE(created_at)'),'<=',$request->to);

            }

        })->where('status','pending')->count();
        $short_declined_count   = Saving::where('type','short')->where(function ($q) use ($request){
            if ($request->has('from') && $request->from) {
                $q->where(DB::raw('DATE(declined_at)'),'>=',$request->from);

            }
            if ($request->has('to') && $request->to) {
                $q->where(DB::raw('DATE(declined_at)'),'<=',$request->to);

            }

        })->where('status','declined')->count();
        $short_closed_count   = Saving::where('type','short')->where(function ($q) use ($request){
            if ($request->has('from') && $request->from) {
                $q->where(DB::raw('DATE(closed_at)'),'>=',$request->from);

            }
            if ($request->has('to') && $request->to) {
                $q->where(DB::raw('DATE(closed_at)'),'<=',$request->to);

            }

        })->where('status','closed')->count();

        $long_active_count   = Saving::where('type','long')->where(function ($q) use ($request){
            if ($request->has('from') && $request->from) {
                $q->where(DB::raw('DATE(approved_at)'),'>=',$request->from);

            }
            if ($request->has('to') && $request->to) {
                $q->where(DB::raw('DATE(approved_at)'),'<=',$request->to);

            }

        })->where('status','approved')->count();
        $long_pending_count   = Saving::where('type','long')->where(function ($q) use ($request){
            if ($request->has('from') && $request->from) {
                $q->where(DB::raw('DATE(created_at)'),'>=',$request->from);

            }
            if ($request->has('to') && $request->to) {
                $q->where(DB::raw('DATE(created_at)'),'<=',$request->to);

            }

        })->where('status','pending')->count();
        $long_declined_count   = Saving::where('type','long')->where(function ($q) use ($request){
            if ($request->has('from') && $request->from) {
                $q->where(DB::raw('DATE(declined_at)'),'>=',$request->from);

            }
            if ($request->has('to') && $request->to) {
                $q->where(DB::raw('DATE(declined_at)'),'<=',$request->to);

            }

        })->where('status','declined')->count();
        $long_closed_count   = Saving::where('type','long')->where(function ($q) use ($request){
            if ($request->has('from') && $request->from) {
                $q->where(DB::raw('DATE(closed_at)'),'>=',$request->from);

            }
            if ($request->has('to') && $request->to) {
                $q->where(DB::raw('DATE(closed_at)'),'<=',$request->to);

            }

        })->where('status','closed')->count();

        $daily_active_count   = Saving::where('type','daily')->where(function ($q) use ($request){
            if ($request->has('from') && $request->from) {
                $q->where(DB::raw('DATE(approved_at)'),'>=',$request->from);

            }
            if ($request->has('to') && $request->to) {
                $q->where(DB::raw('DATE(approved_at)'),'<=',$request->to);

            }

        })->where('status','approved')->count();
        $daily_pending_count   = Saving::where('type','daily')->where(function ($q) use ($request){
            if ($request->has('from') && $request->from) {
                $q->where(DB::raw('DATE(created_at)'),'>=',$request->from);

            }
            if ($request->has('to') && $request->to) {
                $q->where(DB::raw('DATE(created_at)'),'<=',$request->to);

            }

        })->where('status','pending')->count();
        $daily_declined_count   = Saving::where('type','daily')->where(function ($q) use ($request){
            if ($request->has('from') && $request->from) {
                $q->where(DB::raw('DATE(declined_at)'),'>=',$request->from);

            }
            if ($request->has('to') && $request->to) {
                $q->where(DB::raw('DATE(declined_at)'),'<=',$request->to);

            }

        })->where('status','declined')->count();
        $daily_closed_count   = Saving::where('type','daily')->where(function ($q) use ($request){
            if ($request->has('from') && $request->from) {
                $q->where(DB::raw('DATE(closed_at)'),'>=',$request->from);

            }
            if ($request->has('to') && $request->to) {
                $q->where(DB::raw('DATE(closed_at)'),'<=',$request->to);

            }

        })->where('status','closed')->count();

        $current_active_count   = Saving::where('type','current')->where(function ($q) use ($request){
            if ($request->has('from') && $request->from) {
                $q->where(DB::raw('DATE(approved_at)'),'>=',$request->from);

            }
            if ($request->has('to') && $request->to) {
                $q->where(DB::raw('DATE(approved_at)'),'<=',$request->to);

            }

        })->where('status','approved')->count();
        $current_pending_count   = Saving::where('type','current')->where(function ($q) use ($request){
            if ($request->has('from') && $request->from) {
                $q->where(DB::raw('DATE(created_at)'),'>=',$request->from);

            }
            if ($request->has('to') && $request->to) {
                $q->where(DB::raw('DATE(created_at)'),'<=',$request->to);

            }

        })->where('status','pending')->count();
        $current_declined_count   = Saving::where('type','current')->where(function ($q) use ($request){
            if ($request->has('from') && $request->from) {
                $q->where(DB::raw('DATE(declined_at)'),'>=',$request->from);

            }
            if ($request->has('to') && $request->to) {
                $q->where(DB::raw('DATE(declined_at)'),'<=',$request->to);

            }

        })->where('status','declined')->count();
        $current_closed_count   = Saving::where('type','current')->where(function ($q) use ($request){
            if ($request->has('from') && $request->from) {
                $q->where(DB::raw('DATE(closed_at)'),'>=',$request->from);

            }
            if ($request->has('to') && $request->to) {
                $q->where(DB::raw('DATE(closed_at)'),'<=',$request->to);

            }

        })->where('status','closed')->count();

        $loan = Loan::whereIn('status',['active','closed'])->where(function ($q) use ($request){
            if ($request->has('from') && $request->from) {
                $q->where(DB::raw('DATE(approved_at)'),'>=',$request->from);

            }
            if ($request->has('to') && $request->to) {
                $q->where(DB::raw('DATE(approved_at)'),'<=',$request->to);

            }

        })->get();
        $active_count   = Loan::where('status','active')->where(function ($q) use ($request){
            if ($request->has('from') && $request->from) {
                $q->where(DB::raw('DATE(approved_at)'),'>=',$request->from);

            }
            if ($request->has('to') && $request->to) {
                $q->where(DB::raw('DATE(approved_at)'),'<=',$request->to);

            }

        })->count();
        $pending_count   = Loan::where('status','pending')->where(function ($q) use ($request){
            if ($request->has('from') && $request->from) {
                $q->where(DB::raw('DATE(created_at)'),'>=',$request->from);

            }
            if ($request->has('to') && $request->to) {
                $q->where(DB::raw('DATE(created_at)'),'<=',$request->to);

            }

        })->count();
        $declined_count   = Loan::where('status','declined')->where(function ($q) use ($request){
            if ($request->has('from') && $request->from) {
                $q->where(DB::raw('DATE(declined_at)'),'>=',$request->from);

            }
            if ($request->has('to') && $request->to) {
                $q->where(DB::raw('DATE(declined_at)'),'<=',$request->to);

            }

        })->count();
        $closed_count   = Loan::where('status','closed')->where(function ($q) use ($request){
            if ($request->has('from') && $request->from) {
                $q->where(DB::raw('DATE(closed_at)'),'>=',$request->from);

            }
            if ($request->has('to') && $request->to) {
                $q->where(DB::raw('DATE(closed_at)'),'<=',$request->to);

            }

        })->count();

        $fdr_active_count   = Fdr::where('status','approved')->where(function ($q) use ($request){
            if ($request->has('from') && $request->from) {
                $q->where(DB::raw('DATE(approved_at)'),'>=',$request->from);

            }
            if ($request->has('to') && $request->to) {
                $q->where(DB::raw('DATE(approved_at)'),'<=',$request->to);

            }

        })->count();
        $fdr_pending_count   = Fdr::where('status','pending')->where(function ($q) use ($request){
            if ($request->has('from') && $request->from) {
                $q->where(DB::raw('DATE(created_at)'),'>=',$request->from);

            }
            if ($request->has('to') && $request->to) {
                $q->where(DB::raw('DATE(created_at)'),'<=',$request->to);

            }

        })->count();
        $fdr_declined_count   = Fdr::where('status','declined')->where(function ($q) use ($request){
            if ($request->has('from') && $request->from) {
                $q->where(DB::raw('DATE(declined_at)'),'>=',$request->from);

            }
            if ($request->has('to') && $request->to) {
                $q->where(DB::raw('DATE(declined_at)'),'<=',$request->to);

            }

        })->count();
        $fdr_closed_count   = Fdr::where('status','closed')->where(function ($q) use ($request){
            if ($request->has('from') && $request->from) {
                $q->where(DB::raw('DATE(closed_at)'),'>=',$request->from);

            }
            if ($request->has('to') && $request->to) {
                $q->where(DB::raw('DATE(closed_at)'),'<=',$request->to);

            }

        })->count();



        $monthly_data = DB::table('transaction')
        ->select(DB::raw("sum(case when `type`='income' then amount*1 else amount*0 end) as `income`"),DB::raw("sum(case when `type`='expense' then amount*1 else amount*0 end) as `expense`"), DB::raw('MONTH(date) as month'), DB::raw('YEAR(date) as year'))
        ->groupby('month','year')
        ->where('status','approved')
        ->where('canculatable','yes')->where(function ($q) use ($request){
            if ($request->has('from') && $request->from) {
                $q->where(DB::raw('DATE(date)'),'>=',$request->from);

            }
            if ($request->has('to') && $request->to) {
                $q->where(DB::raw('DATE(date)'),'<=',$request->to);

            }

        })
        ->orderBy('date','DESC')
        ->limit(12)
        ->get();

        $pie_chart_data = DB::table('transaction')
        ->select(DB::raw("sum(case when `type`='income' then amount*1 else amount*0 end) as `income`"),DB::raw("sum(case when `type`='expense' then amount*1 else amount*0 end) as `expense`"))
        ->where('status','approved')
        ->where('canculatable','yes')->where(function ($q) use ($request){
            if ($request->has('from') && $request->from) {
                $q->where(DB::raw('DATE(date)'),'>=',$request->from);

            }
            if ($request->has('to') && $request->to) {
                $q->where(DB::raw('DATE(date)'),'<=',$request->to);

            }

        })
        ->first();

        return view('admin/report',compact('members','daily_saving_transactions','daily_savings','short_savings',
        'short_saving_transactions','long_savings','long_saving_transactions','fdr_list','fdr_transactions',
        'loan','active_count','pending_count','declined_count','closed_count','fdr_active_count','fdr_pending_count',
        'fdr_declined_count','fdr_closed_count','monthly_data','pie_chart_data','current_savings','current_saving_transactions',
        'current_active_count','current_pending_count','current_closed_count','daily_active_count','daily_pending_count',
        'daily_closed_count','long_active_count','long_pending_count','long_closed_count','short_active_count','short_pending_count',
        'short_closed_count'));
    }
}
