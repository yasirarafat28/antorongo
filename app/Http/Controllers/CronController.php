<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fdr;
use App\FdrTransaction;
use Carbon\Carbon;
use App\NumberConverter;
use Illuminate\Support\Facades\Auth;

class CronController extends Controller
{
    //



    public function FdrProfitCron()
    {
        $records = Fdr::with('user','transactions','receiver')->where('status','approved')->get();
        $count = 0;
        foreach ($records as $fdr){
            $yearly_interest_rate = $fdr->interest_rate;
            $monthly_interest_rate = $fdr->interest_rate/12;
            $daily_interest_rate = $fdr->interest_rate/365;

            $last_profit = FdrTransaction::where('type','profit')->where('fdr_id',$fdr->id)->orderBy('id','DESC')->first();


            if ($last_profit){
                $last_profit_date = Carbon::parse($last_profit->started_at);
                $now = Carbon::now();
                $fdr_end_at = Carbon::parse($fdr->end_at);

                $duration_diff = $last_profit_date->diffInDays($fdr_end_at);
                $today_diff = $last_profit_date->diffInDays($now);
                for ($i=0;$i<$duration_diff ;$i++ )
                {

                    if ($today_diff< $i)
                    {
                        break;
                    }

                    $deposited = FdrTransaction::where('fdr_id',$fdr->id)->where('type','deposit')->sum('amount');
                    $profit = FdrTransaction::where('fdr_id',$fdr->id)->where('type','profit')->sum('amount');
                    $withdraw = FdrTransaction::where('fdr_id',$fdr->id)->where('type','withdraw')->sum('amount');

                    $next_paid_at = date('Y-m-d H:i:s', strtotime($last_profit_date . '+'.($i+1).' days'));


                    $transaction = new FdrTransaction();
                    $transaction->txn_id = uniqid();
                    $transaction->fdr_id = $fdr->id;
                    $transaction->user_id = $fdr->user_id;
                    $transaction->added_by = Auth::user()->id;
                    $transaction->type = 'profit';
                    $transaction->amount = ($deposited + $profit-$withdraw) *$daily_interest_rate/100;
                    $transaction->note = 'FDR Daily Profit';
                    $transaction->started_at = $next_paid_at;
                    $transaction->status = 'approved';
                    $transaction->manager_status = 'approved';
                    $transaction->admin_status = 'approved';
                    $transaction->save();
                    $count++;
                }
            }else{


                $deposited = FdrTransaction::where('fdr_id',$fdr->id)->where('type','deposit')->sum('amount');
                $profit = FdrTransaction::where('fdr_id',$fdr->id)->where('type','profit')->sum('amount');
                $withdraw = FdrTransaction::where('fdr_id',$fdr->id)->where('type','withdraw')->sum('amount');

                $transaction = new FdrTransaction();
                $transaction->txn_id = uniqid();
                $transaction->fdr_id = $fdr->id;
                $transaction->user_id = $fdr->user_id;
                $transaction->added_by = Auth::user()->id;
                $transaction->type = 'profit';
                $transaction->amount = ($deposited + $profit-$withdraw) *$daily_interest_rate/100;
                $transaction->note = 'FDR Daily Profit';
                $transaction->started_at = $fdr->started_at;
                $transaction->status = 'approved';
                $transaction->manager_status = 'approved';
                $transaction->admin_status = 'approved';
                $transaction->save();
                $count++;
            }

        }

        return back()->withSuccess('Total '.$count.'Profit Calculated');
    }
}
