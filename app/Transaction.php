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
}
