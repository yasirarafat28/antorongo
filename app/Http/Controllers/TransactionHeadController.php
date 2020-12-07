<?php

namespace App\Http\Controllers;

use App\TransactionHead;
use Illuminate\Http\Request;

class TransactionHeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type='income')
    {
        //
        $parents = TransactionHead::where('parent',0)->where('type',$type)->orderBy('id','DESC')->get();
        $records = TransactionHead::with('parent')->where('type',$type)->where('parent','!=',0)->orderBy('id','DESC')->paginate(25);

        return view('admin.transaction-head',compact('records','parents','type'));
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


        $meeting = new TransactionHead();
        $meeting->type = $request->type;
        $meeting->name = $request->name;
        $meeting->slug = $request->slug;
        $meeting->parent = $request->parent;
        $meeting->status = 'active';
        $meeting->save();

        return back()->withSuccess('সফলভাবে সেভ করা হয়েছে');
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



        $meeting = TransactionHead::find($id);
        $meeting->type = $request->type;
        $meeting->name = $request->name;
        $meeting->slug = $request->slug;
        $meeting->parent = $request->parent;
        $meeting->status = 'active';
        $meeting->save();

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

        $meeting = TransactionHead::destroy($id);

        return back()->withSuccess('সফলভাবে ডিলিট  করা হয়েছে');



    }

}
