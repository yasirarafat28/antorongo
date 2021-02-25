<?php

namespace App\Http\Controllers;

use App\DepositoryOrnament;
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

        // saving funtion start

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



        $short_active_count   = Saving::where('type','short')->where('status','approved')->count();
        $short_pending_count   = Saving::where('type','short')->where('status','pending')->count();
        $short_declined_count   = Saving::where('type','short')->where('status','declined')->count();
        $short_closed_count   = Saving::where('type','short')->where('status','closed')->count();

        $short_active_get_id   = Saving::where('type','short')->where('status','approved')->get('id');
        $short_active_saving_transactions = Transaction::with('user','receiver')->where('transaction_for','saving')->where(function ($q) use ($short_active_get_id){
            $q->whereIn('transactable_id',$short_active_get_id);
        })->where('flag','deposit')->sum('amount');




        $long_active_count   = Saving::where('type','long')->where('status','approved')->count();
        $long_pending_count   = Saving::where('type','long')->where('status','pending')->count();
        $long_declined_count   = Saving::where('type','long')->where('status','declined')->count();
        $long_closed_count   = Saving::where('type','long')->where('status','closed')->count();


        $long_active_get_id   = Saving::where('type','short')->where('status','approved')->get('id');
        $long_active_saving_transactions = Transaction::with('user','receiver')->where('transaction_for','saving')->where(function ($q) use ($long_active_get_id){
            $q->whereIn('transactable_id',$long_active_get_id);
        })->where('flag','deposit')->sum('amount');

        $daily_active_count   = Saving::where('type','daily')->where('status','approved')->count();
        $daily_pending_count   = Saving::where('type','daily')->where('status','pending')->count();
        $daily_declined_count   = Saving::where('type','daily')->where('status','declined')->count();
        $daily_closed_count   = Saving::where('type','daily')->where('status','closed')->count();

        $daily_active_get_id   = Saving::where('type','short')->where('status','approved')->get('id');
        $daily_active_saving_transactions = Transaction::with('user','receiver')->where('transaction_for','saving')->where(function ($q) use ($daily_active_get_id){
            $q->whereIn('transactable_id',$daily_active_get_id);
        })->where('flag','deposit')->sum('amount');

        $current_active_count   = Saving::where('type','current')->where('status','approved')->count();
        $current_pending_count   = Saving::where('type','current')->where('status','pending')->count();
        $current_declined_count   = Saving::where('type','current')->where('status','declined')->count();
        $current_closed_count   = Saving::where('type','current')->where('status','closed')->count();


        $current_active_get_id   = Saving::where('type','current')->where('status','approved')->get('id');
        $current_active_saving_transactions = Transaction::with('user','receiver')->where('transaction_for','current')->where(function ($q) use ($current_active_get_id){
            $q->whereIn('transactable_id',$current_active_get_id);
        })->where('flag','deposit')->sum('amount');

        // saving function end


        // loan function start

        $loan = Loan::whereIn('status',['active','closed'])->get();
        $active_count   = Loan::where('status','active')->count();
        $pending_count   = Loan::where('status','pending')->count();
        $declined_count   = Loan::where('status','declined')->count();
        $closed_count   = Loan::where('status','closed')->count();

        $loan_active_list   = Loan::where('status','active')->get('id');
        $loan_active_transactions = Transaction::with('user','receiver')->where('transaction_for','loan')->where(function ($q) use ($loan_active_list){
            $q->whereIn('transactable_id',$loan_active_list);
        })->where('flag','give_away')->sum('amount');

        $loan_active_interest_total = Transaction::with('user','receiver')->where('transaction_for','loan')->where(function ($q) use ($loan_active_list){
            $q->whereIn('transactable_id',$loan_active_list);
        })->where('flag','interest')->sum('amount');

        $loan_reveanue_paid_total = Transaction::with('user','receiver')->where('transaction_for','loan')->where(function ($q) use ($loan_active_list){
            $q->whereIn('transactable_id',$loan_active_list);
        })->where('flag','revenue_deduct')->sum('amount');

        $loan_reveanue_add_total = Transaction::with('user','receiver')->where('transaction_for','loan')->where(function ($q) use ($loan_active_list){
            $q->whereIn('transactable_id',$loan_active_list);
        })->where('flag','revenue_add')->sum('amount');

        $loan_interest_added_total = Transaction::with('user','receiver')->where('transaction_for','loan')->where(function ($q) use ($loan_active_list){
            $q->whereIn('transactable_id',$loan_active_list);
        })->where('flag','add_interest')->sum('amount');

        $loan_profit_waiver_total = Transaction::with('user','receiver')->where('transaction_for','loan')->where(function ($q) use ($loan_active_list){
            $q->whereIn('transactable_id',$loan_active_list);
        })->where('flag','loan_waiver')->sum('amount');

        //Ornament Depository
        // $loan_ornament_active_id = Loan::where('status','active')->get();
        $loan_ornament_list = DepositoryOrnament::where('status','active')->count('loan_id');

        // loan function end


        // Fdr function start

        $fdr_active_count   = Fdr::where('status','approved')->count();
        $fdr_pending_count   = Fdr::where('status','pending')->count();
        $fdr_declined_count   = Fdr::where('status','declined')->count();
        $fdr_closed_count   = Fdr::where('status','closed')->count();

        $fdr_list = Fdr::get('id');
        $fdr_transactions = Transaction::with('user','receiver')->where('transaction_for','fdr')->where(function ($q) use ($fdr_list){
            $q->whereIn('transactable_id',$fdr_list);
        })->where('flag','deposit')->sum('amount');

        $fdr_active_list = Fdr::where('status','approved')->get('id');
        $fdr_active_transactions = Transaction::with('user','receiver')->where('transaction_for','fdr')->where(function ($q) use ($fdr_active_list){
            $q->whereIn('transactable_id',$fdr_active_list);
        })->where('flag','deposit')->sum('amount');

        // Fdr function start

        $monthly_data = DB::table('transaction')
        ->select(DB::raw("sum(case when `type`='income' then amount*1 else amount*0 end) as `income`"),DB::raw("sum(case when `type`='expense' then amount*1 else amount*0 end) as `expense`"), DB::raw('MONTH(date) as month'), DB::raw('YEAR(date) as year'))
        ->groupby('month','year')
        ->where('status','approved')
        ->where('canculatable','yes')
        ->orderBy('date','DESC')
        ->limit(12)
        ->get();

        $pie_chart_data = DB::table('transaction')
        ->select(DB::raw("sum(case when `type`='income' then amount*1 else amount*0 end) as `income`"),DB::raw("sum(case when `type`='expense' then amount*1 else amount*0 end) as `expense`"))
        ->where('status','approved')
        ->where('canculatable','yes')
        ->first();

        //office will give

            $office_saving_active_list = Saving::where('status','approved')->get('id');
            $office_fdr_active_list = Fdr::where('status','approved')->get('id');

            $office_deposit_totalCreadit = Transaction::with('user','receiver')->where('transaction_for','saving')->where(function ($q) use ($office_saving_active_list){
                $q->whereIn('transactable_id',$office_saving_active_list);
            })->whereIn('flag',['deposit'])->where('status','approved')->sum('amount');

            // $office_deposit_totalCreadit  = Transaction::whereIn('flag',['deposit'])->where('transaction_for','saving')
            //     ->where('status','approved')->sum('amount');

            $office_deposit_withdrawtotalDebit = Transaction::with('user','receiver')->where('transaction_for','saving')->where(function ($q) use ($office_saving_active_list){
                $q->whereIn('transactable_id',$office_saving_active_list);
            })->whereIn('flag',['deposit_withdraw'])->where('status','approved')->sum('amount');


            // $office_deposit_withdrawtotalDebit  = Transaction::whereIn('flag',['deposit_withdraw'])->where('transaction_for','saving')
            // ->where('status','approved')->sum('amount');

            $office_deposit_balance = $office_deposit_totalCreadit - $office_deposit_withdrawtotalDebit;

            $office_porfit_totalCreadit = Transaction::with('user','receiver')->where('transaction_for','saving')->where(function ($q) use ($office_saving_active_list){
                $q->whereIn('transactable_id',$office_saving_active_list);
            })->whereIn('flag',['profit'])->where('status','approved')->sum('amount');

            // $office_porfit_totalCreadit  = Transaction::whereIn('flag',['profit'])->where('transaction_for','saving')
            //     ->where('status','approved')->sum('amount');

            $office_profit_withdraw_totalDebit = Transaction::with('user','receiver')->where('transaction_for','saving')->where(function ($q) use ($office_saving_active_list){
                $q->whereIn('transactable_id',$office_saving_active_list);
            })->whereIn('flag',['profit_withdraw'])->where('status','approved')->sum('amount');

            // $office_profit_withdraw_totalDebit  = Transaction::whereIn('flag',['profit_withdraw'])->where('transaction_for','saving')
            // ->where('status','approved')->sum('amount');

            $office_profit_balance = $office_porfit_totalCreadit - $office_profit_withdraw_totalDebit;

            $office_fdr_d_totalCreadit = Transaction::with('user','receiver')->where('transaction_for','fdr')->where(function ($q) use ($office_fdr_active_list){
                $q->whereIn('transactable_id',$office_fdr_active_list);
            })->whereIn('flag',['deposit'])->where('status','approved')->sum('amount');

                // $office_fdr_d_totalCreadit  = Transaction::whereIn('flag',['deposit'])->where('transaction_for','fdr')
                //     ->where('status','approved')->sum('amount');

                $office_fdr_w_totalDebit = Transaction::whereHas('head',function($q){
                         $q->where('slug','fdr_refund_expense');
                    })->with('user','receiver')->where('transaction_for','fdr')->where(function ($q) use ($office_fdr_active_list){
                    $q->whereIn('transactable_id',$office_fdr_active_list);
                })->whereIn('flag',['withdraw'])->where('status','approved')->sum('amount');

                // $office_fdr_w_totalDebit  = Transaction::whereHas('head',function($q){
                //     $q->where('slug','fdr_refund_expense');
                // })->whereIn('flag',['withdraw'])->where('transaction_for','fdr')
                // ->where('status','approved')->sum('amount');

               $office_fdr_d_balance = $office_fdr_d_totalCreadit - $office_fdr_w_totalDebit;

               $office_fdr_p_totalCreadit = Transaction::with('user','receiver')->where('transaction_for','fdr')->where(function ($q) use ($office_fdr_active_list){
                $q->whereIn('transactable_id',$office_fdr_active_list);
            })->whereIn('flag',['profit'])->where('status','approved')->sum('amount');

                // $office_fdr_p_totalCreadit  = Transaction::whereIn('flag',['profit'])->where('transaction_for','fdr')
                //     ->where('status','approved')->sum('amount');

                $office_fdr_p_w_totalDebit = Transaction::with('user','receiver')->where('transaction_for','fdr')->where(function ($q) use ($office_fdr_active_list){
                    $q->whereIn('transactable_id',$office_fdr_active_list);
                })->whereIn('flag',['withdraw'])->where('status','approved')->sum('amount');

                // $office_fdr_p_w_totalDebit  = Transaction::whereIn('flag',['withdraw'])->whereHas('head',function($q){
                //     $q->where('slug','fdr_profit_expense');
                // })->where('transaction_for','fdr')
                // ->where('status','approved')->sum('amount');

                $office_fdr_p_balance = $office_fdr_p_totalCreadit-$office_fdr_p_w_totalDebit;



        return view('admin/dashboard',compact('members','daily_saving_transactions','daily_savings','short_savings',
        'short_saving_transactions','long_savings','long_saving_transactions','fdr_list','fdr_transactions',
        'loan','active_count','pending_count','declined_count','closed_count','fdr_active_count','fdr_pending_count',
        'fdr_declined_count','fdr_closed_count','monthly_data','pie_chart_data','current_savings','current_saving_transactions',
        'current_active_count','current_pending_count','current_closed_count','daily_active_count','daily_pending_count',
        'daily_closed_count','long_active_count','long_pending_count','long_closed_count','short_active_count','short_pending_count',
        'short_closed_count','short_active_saving_transactions','long_active_saving_transactions','daily_active_saving_transactions',
        'current_active_saving_transactions','fdr_active_transactions','loan_active_transactions','loan_active_interest_total','loan_reveanue_paid_total',
        'loan_reveanue_add_total','loan_interest_added_total','loan_profit_waiver_total','loan_ornament_list',
        'office_deposit_balance','office_profit_balance','office_fdr_d_balance','office_fdr_p_balance'));
    }

}
