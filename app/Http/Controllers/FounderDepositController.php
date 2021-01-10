<?php

namespace App\Http\Controllers;

use App\FounderDeposit;
use App\NumberConverter;
use App\Transaction;
use App\TransactionHead;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FounderDepositController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

        $records = FounderDeposit::where(function ($q) use ($request){
            if ($request->has('from') && $request->from) {
                $from = date("Y-m-d", strtotime($request->from));
                $q->where(DB::raw('DATE(started_at)'),'>=',$from);

            }
            if ($request->has('to') && $request->to) {

                $to = date("Y-m-d", strtotime($request->to));
                $q->where(DB::raw('DATE(started_at)'),'<=',$to);

            }

        })
        ->orderBy('created_at','DESC');
        if(isset($request->limit) && $request->limit=='-1'){
            $records = $records->paginate($records->count());
        }else{
            $records = $records->paginate(25);
        }

        $count = FounderDeposit::where('status','active')->count();
        $total_deposit = Transaction::whereIn('flag',['deposit'])->where('transaction_for','founder_deposit')
        ->where('status','approved')->sum('amount');

        $total_withdraw  = Transaction::whereIn('flag',['withdraw'])->where('transaction_for','founder_deposit')
        ->where('status','approved')->sum('amount');

        return view('admin.founder_deposit.index',compact('records','count','total_deposit','total_withdraw'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //


        $members = User::where('role','member')
        //->where('project','founding_member')
        ->orderBy('name','ASC')->get();

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


    public function withdraw(Request $request,$id)
    {
        //
        $this->validate($request,[
            'amount'=>'required',
            'date'=>'required',
        ]);

        $row = FounderDeposit::find($id);


        $head = TransactionHead::where('slug','founder_withdraw_expense')->first();

        if(!$head){
            return back()->withError('Related head didn\'t found!');
        }
        $deposit = new Transaction();
        $deposit->txn_id = uniqid();
        $deposit->transaction_for = 'founder_deposit';
        $deposit->transactable_id = $id;
        $deposit->flag = 'withdraw';
        $deposit->type = 'expense';
        $deposit->head_id = $head->id;
        $deposit->user_id = $row->user_id;
        $deposit->note = $row->note;
        $deposit->date = $request->date;
        $deposit->amount = NumberConverter::bn2en($request->amount);
        $deposit->added_by = Auth::user()->id;
        $deposit->received_by = Auth::user()->id;
        $deposit->admin_status ='approved';
        $deposit->manager_status = 'approved';
        $deposit->status = 'approved';
        $deposit->save();


        return back()->withSuccess('সফলভাবে সেভ করা হয়েছে!');
    }


    public function profit(Request $request,$id)
    {
        $this->validate($request,[
        'amount'=>'required',
        'date'=>'required',
    ]);

        $row = FounderDeposit::find($id);


        $head = TransactionHead::where('slug','founder_profit_expense')->first();

        if(!$head){
            return back()->withError('Related head didn\'t found!');
        }
        $deposit = new Transaction();
        $deposit->txn_id = uniqid();
        $deposit->transaction_for = 'founder_deposit';
        $deposit->transactable_id = $id;
        $deposit->flag = 'profit';
        $deposit->type = 'expense';
        $deposit->head_id = $head->id;
        $deposit->user_id = $row->user_id;
        $deposit->note = $row->note;
        $deposit->date = $request->date;
        $deposit->amount = NumberConverter::bn2en($request->amount);
        $deposit->added_by = Auth::user()->id;
        $deposit->received_by = Auth::user()->id;
        $deposit->admin_status ='approved';
        $deposit->manager_status = 'approved';
        $deposit->status = 'approved';
        $deposit->save();


        return back()->withSuccess('সফলভাবে সেভ করা হয়েছে!');
    }
}
