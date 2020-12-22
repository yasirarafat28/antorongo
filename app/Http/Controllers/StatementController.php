<?php

namespace App\Http\Controllers;

use App\Loan;
use App\Transaction;
use Illuminate\Http\Request;
use App\TransactionHead;

class StatementController extends Controller
{
    // function __construct()
    // {
    //     $this->middleware('permission:statement-customize', ['only' => ['customize']]);
    //     $this->middleware('permission:daily-statement', ['only' => ['dailyStatement']]);

    // }


    public function daily(Request $request)
    {
        return view('admin/statement/daily');
    }
    public function customize(Request $request)
    {

        $income_heads = TransactionHead::with('childs')->where('parent',0)->where('type','income')->get();
        $expense_heads = TransactionHead::with('childs')->where('parent',0)->where('type','expense')->get();
        return view('admin/statement/customize',compact('income_heads','expense_heads'));
    }

    public function dailyStatement(){

        return view('admin/statement/daily-statement');
    }
}
