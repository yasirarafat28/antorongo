<?php

namespace App\Http\Controllers;

use App\Fdr;
use App\Loan;
use App\Saving;
use App\Transaction;
use Illuminate\Http\Request;

class AuditController extends Controller

{

    public function savingAudit(Request $request, $type)
    {


    $records = Saving::with('user')->where('status','approved')->where(function ($q) use ($request){

        $q->where('type', $request->type);

        if ($request->has('from') && $request->from) {
            $from = date("Y-m-d", strtotime($request->from));
            $q->where('started_at', '>=',  $from);

        }
        if ($request->has('to') && $request->to) {

            $to = date("Y-m-d", strtotime($request->to));
            $q->where('started_at', '<=',  $to);

        }
        // if ($request->has('filterBy') && $request->filterBy !='all') {
        //     $q->where('status', $request->filterBy);

        // }




    })->orderBy('created_at','DESC');

    if(isset($request->limit) && $request->limit=='-1'){

        $records = $records->paginate($records->count());
    }else{
        $records = $records;
    if(isset($request->limit) && $request->limit=='-1'){

        $records = $records->paginate($records->count());
    }else{

        $records = $records->paginate(25);
    }

    }



    // $records = Saving::with('user')->where('type','short')->where(function($q) use($request){

    //     if ($request->has('from') && $request->from) {
    //         $from = date("Y-m-d", strtotime($request->from));
    //         $q->where('started_at', '>=',  $from);

    //     }
    //     if ($request->has('to') && $request->to) {

    //         $to = date("Y-m-d", strtotime($request->to));
    //         $q->where('started_at', '<=',  $to);

    //     }
    //     if ($request->has('filterBy') && $request->filterBy !='all') {
    //         $q->where('status', $request->filterBy);

    //     }
    // })->orderBy('created_at','DESC');

    //     if(isset($request->limit) && $request->limit=='-1'){

    //         $records = $records->paginate($records->count());
    //     }else{
    //         $records = $records;
    //     }
    //     if(isset($request->limit) && $request->limit=='-1'){

    //         $records = $records->paginate($records->count());
    //     }else{

    //         $records = $records->paginate(25);
    //     }


    return view('admin/Audit/saving-audit-list',compact('records','type'));
}

public function fdrAudit(Request $request){

    $records = Fdr::with('user')->where('status','approved')->where(function ($q) use ($request){



        if ($request->has('from') && $request->from) {
            $from = date("Y-m-d", strtotime($request->from));
            $q->where('started_at', '>=',  $from);

        }
        if ($request->has('to') && $request->to) {

            $to = date("Y-m-d", strtotime($request->to));
            $q->where('started_at', '<=',  $to);

        }
        // if ($request->has('filterBy') && $request->filterBy !='all') {
        //     $q->where('status', $request->filterBy);

        // }




    })->orderBy('created_at','DESC');

    if(isset($request->limit) && $request->limit=='-1'){

        $records = $records->paginate($records->count());
    }else{
        $records = $records;
    if(isset($request->limit) && $request->limit=='-1'){

        $records = $records->paginate($records->count());
    }else{

        $records = $records->paginate(25);
    }

    }

    return view('admin.audit.fdr-audit-list',compact('records'));
}

public function loanAudit(Request $request){

    $records = Loan::where('status','active')->where(function ($q) use ($request){



        if ($request->has('from') && $request->from) {
            $from = date("Y-m-d", strtotime($request->from));
            $q->where('started_at', '>=',  $from);

        }
        if ($request->has('to') && $request->to) {

            $to = date("Y-m-d", strtotime($request->to));
            $q->where('started_at', '<=',  $to);

        }
    });

    // $active_loan_list = Loan::where('status','active')->get('id');

    // $records = Transaction::with('user','receiver')->where('transaction_for','loan')->where(function ($q) use ($active_loan_list){
    //     $q->whereIn('transactable_id',$active_loan_list);

    //  if ($request->has('from') && $request->from) {
    //         $from = date("Y-m-d", strtotime($request->from));
    //         $q->where('started_at', '>=',  $from);

    //     }
    //     if ($request->has('to') && $request->to) {

    //         $to = date("Y-m-d", strtotime($request->to));
    //         $q->where('started_at', '<=',  $to);

    //     }
        // if ($request->has('filterBy') && $request->filterBy !='all') {
        //     $q->where('status', $request->filterBy);

        // }

    // })->where('flag','give_away')
    // ->groupby('user_id');

    //return $records;

    if(isset($request->limit) && $request->limit=='-1'){

        $records = $records->paginate($records->count());
    }else{
        $records = $records;
    if(isset($request->limit) && $request->limit=='-1'){

        $records = $records->paginate($records->count());
    }else{

        $records = $records->paginate(25);
    }

    }

    return view('admin.audit.loan-audit-list',compact('records'));
}

}
