<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Loan;
use App\LoanTransaction;
use App\NumberConverter;
use App\User;
use Auth;


class LoanTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //


        $loan_transaction = LoanTransaction::find($id);
        $loan = Loan::find($loan_transaction->loan_id);
        $members = User::where('role','member')->orderBy('name','ASC')->get();



        $users_loans = Loan::with('user')->where('user_id',$loan->user_id)->get();
        return view('admin/loan-transaction-edit',compact('members','loan_transaction','loan','users_loans'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //



        $this->validate($request,
            [
                'amount' => 'required',
                'date' => 'required',
                'loan_id' => 'required',
                'user_id' => 'required',
            ]
        );


        $transaction = LoanTransaction::find($id);
        $transaction->loan_id = $request->loan_id;
        $transaction->user_id = $request->user_id;
        $transaction->received_by = Auth::user()->id;
        if ($transaction->type=='collect') {
            $transaction->incoming = NumberConverter::bn2en($request->amount);
        }else
            $transaction->outgoing = NumberConverter::bn2en($request->amount);
        $transaction->date = $request->date;
        $transaction->status = 'approved';
        $transaction->manager_status = 'approved';
        $transaction->admin_status = 'approved';
        $transaction->save();

        return back()->withSuccess('সফলভাবে সেভ করা হয়েছে');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        LoanTransaction::destroy($id);

        return back()->withSuccess('সফলভাবে মুছে ফেলা হয়েছে');
    }
}
