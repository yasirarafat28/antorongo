<?php

namespace App\Http\Controllers;

use App\FounderDeposit;
use App\NumberConverter;
use App\Transaction;
use App\TransactionHead;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FounderDepositController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $records = FounderDeposit::paginate(20);
        return view('admin.founder_deposit.index',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //


        $members = User::where('role','member')->orderBy('name','ASC')->get();

        return view('admin.founder_deposit.create',compact('members'));
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

        $this->validate($request,[
            'user_id'=>'required',
            'amount'=>'required',
            'date'=>'required',
        ]);

        $row =new FounderDeposit();
        $row->txn_id = uniqid();
        $row->user_id = $request->user_id;
        //$row->amount = $request->amount;
        $row->note = $request->note;
        $row->started_at = $request->date;
        $row->status = 'active';
        $row->save();



        $head = TransactionHead::where('slug','founder_deposit_income')->first();

        if(!$head){
            return back()->withError('Related head didn\'t found!');
        }
        $deposit = new Transaction();
        $deposit->txn_id = uniqid();
        $deposit->transaction_for = 'founder_deposit';
        $deposit->transactable_id = $row->id;
        $deposit->flag = 'deposit';
        $deposit->type = 'income';
        $deposit->head_id = $head->id;
        $deposit->user_id = $row->user_id;
        $deposit->note = $row->note;
        $deposit->date = $row->started_at;
        $deposit->amount = NumberConverter::bn2en($request->amount);
        $deposit->added_by = Auth::user()->id;
        $deposit->received_by = Auth::user()->id;
        $deposit->admin_status ='approved';
        $deposit->manager_status = 'approved';
        $deposit->status = 'approved';
        $deposit->save();


        return back()->withSuccess('সফলভাবে সেভ করা হয়েছে!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $row = FounderDeposit::find($id);


        return view('admin.founder_deposit.show',compact('row'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $members = User::where('role','member')->orderBy('name','ASC')->get();
        $row = FounderDeposit::find($id);

        return view('admin.founder_deposit.edit',compact('members','row'));
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


        $this->validate($request,[
            'user_id'=>'required',
            'amount'=>'required',
            'date'=>'required',
        ]);

        $row =FounderDeposit::find($id);
        $row->user_id = $request->user_id;
        $row->amount = $request->amount;
        $row->note = $request->note;
        $row->started_at = $request->date;
        $row->status = $request->status;
        $row->save();

        return back()->withSuccess('সফলভাবে সেভ করা হয়েছে!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $row =FounderDeposit::destroy($id);
        Transaction::where('transaction_for','founder_deposit')->where('transactable_id',$id)->delete();
        return redirect('admin/dashboard')->withSuccess('সফলভাবে মুছে ফেলা হয়েছে');
    }
}
