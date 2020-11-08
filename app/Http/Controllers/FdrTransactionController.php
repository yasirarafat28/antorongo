<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FdrTransaction;
use App\Fdr;
use App\User;
use Auth;

class FdrTransactionController extends Controller
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

        $fdr_transaction = FdrTransaction::find($id);
        $fdr = Fdr::find($fdr_transaction->fdr_id);
        $members = User::where('role','member')->orderBy('name','ASC')->get();



        $users_fdrs = Fdr::with('user')->where('user_id',$fdr_transaction->user_id)->get();
        return view('admin/fdr/transaction-edit',compact('members','fdr_transaction','fdr','users_fdrs'));
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



        $transaction = FdrTransaction::find($id);
        $transaction->fdr_id = $request->fdr_id;
        $transaction->user_id = $request->user_id;
        $transaction->amount = $request->amount;
        $transaction->added_by = Auth::user()->id;
        $transaction->started_at = $request->date;
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
        //
        Fdr::destroy($id);

        return back()->withSuccess('সফলভাবে মুছে ফেলা হয়েছে');
    }
}
