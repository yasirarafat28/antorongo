<?php

namespace App\Http\Controllers;

use App\Enquiry;
use Illuminate\Http\Request;

class EnquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Enquiry::orderBy('created_at','DESC')->paginate(25);

        return view('admin.web-site.enquiry.index',compact('records'));
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
        $this->validate($request,[
            'first_name' =>  'required',
            'email' =>  'required',
            'subject' =>  'required',
            'description' =>  'required',

        ]);

        $enquriry = new Enquiry();
        $enquriry->first_name = $request->first_name;
        $enquriry->last_name = $request->last_name;
        $enquriry->email = $request->email;
        $enquriry->phone = $request->phone;
        $enquriry->subject = $request->subject;
        $enquriry->description = $request->description;
        $enquriry->save();

        return back()->withSuccess('আপনার বার্তা সফলভাবে পাঠানো হয়েছে!');
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Enquiry::destroy($id);
        return back()->withSuccess('সফলভাবে মুছে ফেলা হয়েছে');
    }
}
