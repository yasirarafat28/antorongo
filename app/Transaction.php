<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Transaction extends Model
{
    //

    protected $table = 'transaction';
    protected $primaryKey = 'id';



    public function user()
    {
        return $this->belongsTo('App\User','user_id');

    }

    public function head()
    {
        return $this->belongsTo('App\TransactionHead','head_id');

    }


    public function receiver()
    {
        return $this->belongsTo('App\User','received_by');

    }

    public function savings()
    {
        return $this->belongsTo('App\Saving','transactable_id');
    }

    public function fdr()
    {
        return $this->belongsTo('App\Fdr','transactable_id');
    }

    public function loan()
    {
        return $this->belongsTo('App\Loan','transactable_id');
    }

    public static function TransactionByHeadDate($id,$from,$to)
    {

        $from = date("Y-m-d", strtotime($from));
        $to = date("Y-m-d", strtotime($to));
        //return $to;
        $transaction_head = TransactionHead::find($id);
        if ($transaction_head->parent==0)
        {
            $transactions = 0;
            $transactions += Transaction::where('head_id',$id)->where(function($q) use($from,$to){
                if($from){
                    $q->where(DB::raw('DATE(date)'),'>=',$from);
                }
                if($to){
                    $q->where(DB::raw('DATE(date)'),'<=',$to);
                }
            })->sum('amount');
            $childs = TransactionHead::where('parent',$transaction_head->id)->get();
            foreach ($childs as $item)
            {
                $transactions += Transaction::where('head_id',$item->id)->where(function($q) use($from,$to){
                    if($from){
                        $q->where(DB::raw('DATE(date)'),'>=',$from);
                    }
                    if($to){
                        $q->where(DB::raw('DATE(date)'),'<=',$to);
                    }
                })->sum('amount');
            }

        }else
            $transactions = Transaction::where('head_id',$id)->where(function($q) use($from,$to){
                if($from){
                    $q->where(DB::raw('DATE(date)'),'>=',$from);
                }
                if($to){
                    $q->where(DB::raw('DATE(date)'),'<=',$to);
                }
            })->get();

        return $transactions;
    }


    public static function total_by_slug_date($slug,$from,$to)
    {


        $from = date("Y-m-d", strtotime($from));
        $to = date("Y-m-d", strtotime($to));
        //return $to;
        $transaction_head = TransactionHead::where('slug',$slug)->first();
        if(!$transaction_head){
            return 0;
        }


        $transactions = 0;
        $transactions += Transaction::where('head_id',$transaction_head->id)
        ->where(function($q) use($from,$to){
            if($from){
                $q->where(DB::raw('DATE(date)'),'>=',$from);
            }
            if($to){
                $q->where(DB::raw('DATE(date)'),'<=',$to);
            }
        })
        ->sum('amount');

        if ($transaction_head->parent==0)
        {
            $childs = TransactionHead::where('parent',$transaction_head->id)->get('id')->pluck('id')->toArray();
            $transactions += Transaction::whereIn('head_id',$childs)
            ->where(function($q) use($from,$to){
                if($from){
                    $q->where(DB::raw('DATE(date)'),'>=',$from);
                }
                if($to){
                    $q->where(DB::raw('DATE(date)'),'<=',$to);
                }
            })
                ->sum('amount');

        }

        return $transactions;
    }

    public static function total_by_slug_account_project_date($slug,$project,$from,$to)
    {


        $from = date("Y-m-d", strtotime($from));
        $to = date("Y-m-d", strtotime($to));
        //return $to;
        $transaction_head = TransactionHead::where('slug',$slug)->first();
        if(!$transaction_head){
            return 0;
        }


        $transactions = 0;
        $transactions += Transaction::with('user')->whereHas('user',function($q) use($project){

            $q->whereIn('project',$project);
        })->where('head_id',$transaction_head->id)
        ->where(function($q) use($from,$to){
            if($from){
                $q->where(DB::raw('DATE(date)'),'>=',$from);
            }
            if($to){
                $q->where(DB::raw('DATE(date)'),'<=',$to);
            }
        })
        ->sum('amount');

        if ($transaction_head->parent==0)
        {
            $childs = TransactionHead::with('user')->whereHas('user',function($q) use($project){

                $q->where('project',$project);
            })->where('parent',$transaction_head->id)->get('id')->pluck('id')->toArray();
            $transactions += Transaction::whereIn('head_id',$childs)
            ->where(function($q) use($from,$to){
                if($from){
                    $q->where(DB::raw('DATE(date)'),'>=',$from);
                }
                if($to){
                    $q->where(DB::raw('DATE(date)'),'<=',$to);
                }
            })
                ->sum('amount');

        }

        return $transactions;
    }
}
