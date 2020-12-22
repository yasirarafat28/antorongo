<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

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
            $transactions += Transaction::where('head_id',$id)->where('date', '>=',  $from)->where('date', '<=',  $to)->sum('amount');
            $childs = TransactionHead::where('parent',$transaction_head->id)->get();
            foreach ($childs as $item)
            {
                $transactions += Transaction::where('head_id',$item->id)->where('date', '>=',  $from)->where('date', '<=',  $to)->sum('amount');
            }

        }else
            $transactions = Transaction::where('head_id',$id)->where('date', '>=',  $from)->where('date', '<=',  $to)->get();

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
        ->where('date', '>=',  $from)
        ->where('date', '<=',  $to)
        ->sum('amount');

        if ($transaction_head->parent==0)
        {
            $childs = TransactionHead::where('parent',$transaction_head->id)->get('id')->pluck('id')->toArray();
            $transactions += Transaction::whereIn('head_id',$childs)
                ->where('date', '>=',  $from)
                ->where('date', '<=',  $to)
                ->sum('amount');

        }

        return $transactions;
    }
}
