<?php

namespace App\Http\Controllers;

use App\TransactionHead;
use Illuminate\Http\Request;

class TransactionHeadController extends Controller
{
    // function __construct()
    // {
    //     $this->middleware('permission:transaction-head-income-list', ['only' => ['index']]);
    //     $this->middleware('permission:transaction-head-income-create', ['only' => ['create','store']]);
    //     $this->middleware('permission:transaction-head-income-edit', ['only' => ['edit','update']]);
    //     $this->middleware('permission:transaction-head-income-delete', ['only' => ['destroy']]);
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request ,$type='income')
    {
        //
        $parents = TransactionHead::where('parent',0)->where('type',$type)->orderBy('id','DESC')->get();

        $records = TransactionHead::with('parent')->where('type',$type)->where('parent','!=',0)->orderBy('id','DESC');
        if(isset($request->limit) && $request->limit=='-1'){
            $records = $records->paginate($records->count());
        }else{
            $records = $records->paginate(25);
        }

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
