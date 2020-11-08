<?php

namespace App\Http\Controllers;

use App\Points;
use Illuminate\Http\Request;
use Auth;

class ReportController extends Controller
{
    //

    public function accountant(Request $request)
    {



        $records = Points::with('user','product','processor')->where('processing_by',Auth::user()->id)->where(function ($q) use ($request){
            $q->where('transaction_type','sent');
            $q->where('point_type','withdraw');

            if ($request->has('from') && $request->from) {
                $from = date("Y-m-d", strtotime($request->from));
                $q->where('expected_approved_date', '>=',  $from);

            }
            if ($request->has('to') && $request->to) {

                $to = date("Y-m-d", strtotime($request->to));
                $q->where('expected_approved_date', '<=',  $to);

            }


        })->orderBy('processing_date','DESC')->get();

        $total = $records->sum('amount');

        return view('account-officer/reports',compact('records','total'));
    }
}
