<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Contact::orderBy('created_at','DESC')->paginate('25');

        return view('admin.web-site.contact.index',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.web-site.contact.create');
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

        ]);

        $contacts = new Contact();
        $contacts->phone_no = $request->phone_no;
        $contacts->mobile_no = $request->mobile_no;
        $contacts->address = $request->address;
        $contacts->gmail = $request->gmail;
        $contacts->status = $request->status;
        $contacts->save();

        return redirect('admin/contacts')->withSuccess('সফলভাবে সেভ করা হয়েছে');
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

        $this->validate($request,[

            ]);

            $contacts = Contact::find($id);
            $contacts->phone_no = $request->phone_no;
            $contacts->mobile_no = $request->mobile_no;
            $contacts->address = $request->address;
            $contacts->gmail = $request->gmail;
            $contacts->status = $request->status;
            $contacts->save();

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
        Contact::destroy($id);
        return back()->withSuccess('সফলভাবে মুছে ফেলা হয়েছে');
    }
}
