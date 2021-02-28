<?php

namespace App\Http\Controllers;

use App\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Team::orderBy('created_at','DESC')->paginate(25);
        return view('admin.web-site.team.index',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.web-site.team.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $teams = new Team();
        $teams->name = $request->name;
        $teams->title = $request->title;
        $teams->description = $request->description;
        $teams->status = $request->status;

        if ($request->hasFile('photo')) {

            $image      = $request->file('photo');
            $imageName  = 'teamss_'.date('ymdhis').'.'.$image->getClientOriginalExtension();
            $path       = 'images/file/';
            $image->move($path, $imageName);
            $imageUrl   = $path . $imageName;
            $teams->photo = $imageUrl;
        }

        $teams->save();
        return redirect('admin/teams')->with('success','সফলভাবে সেভ করা হয়েছে');
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
        $teams = Team::find($id);
        $teams->name = $request->name;
        $teams->title = $request->title;
        $teams->description = $request->description;
        $teams->status = $request->status;

        if ($request->hasFile('photo')) {

            $image      = $request->file('photo');
            $imageName  = 'teamss_'.date('ymdhis').'.'.$image->getClientOriginalExtension();
            $path       = 'images/file/';
            $image->move($path, $imageName);
            $imageUrl   = $path . $imageName;
            $teams->photo = $imageUrl;
        }

        $teams->save();
        return back()->with('success','সফলভাবে সেভ করা হয়েছে');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Team::destroy($id);
        return back()->with('success','সফলভাবে সেভ করা হয়েছে');

    }
}
