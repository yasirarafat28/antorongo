<?php

namespace App\Http\Controllers;

use App\Meeting;
use Illuminate\Http\Request;

class MeetingController extends Controller
{
    //  function __construct()
    // {
    //     $this->middleware('permission:meeting-list', ['only' => ['index']]);
    //     $this->middleware('permission:meeting-create', ['only' => ['create','store']]);
    //     $this->middleware('permission:meeting-edit', ['only' => ['update']]);
    //     $this->middleware('permission:meeting-delete', ['only' => ['destroy']]);
    // }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $records = Meeting::orderBy('id','DESC');
        if(isset($request->limit) && $request->limit=='-1'){
            $records = $records->paginate($records->count());
        }else{
            $records = $records->paginate(25);
        }

        return view('admin/meeting',compact('records'));
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

        $meeting = new Meeting();
        $meeting->subject = $request->subject;
        $meeting->guest = $request->guest;
        $meeting->details = $request->details;
        $meeting->decision = $request->decision;
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



        $meeting = Meeting::find($id);
        $meeting->subject = $request->subject;
        $meeting->guest = $request->guest;
        $meeting->details = $request->details;
        $meeting->decision = $request->decision;
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
        $meeting = Meeting::destroy($id);

        return back()->withSuccess('সফলভাবে মুছে ফেলা হয়েছে');
    }
}
