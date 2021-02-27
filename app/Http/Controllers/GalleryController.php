<?php

namespace App\Http\Controllers;

use App\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Gallery::orderBy('created_at','DESC')->paginate(25);
        return view('admin.web-site.gallery.index',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.web-site.gallery.create');
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

        $galleries = new Gallery();
        $galleries->title = $request->title;
        if($request->title){
            $galleries->flag = 'web_title';
        }
        $galleries->status = $request->status;

        if ($request->hasFile('cover_photo')) {

            $image      = $request->file('cover_photo');
            $imageName  = 'gallery_c'.date('ymdhis').'.'.$image->getClientOriginalExtension();
            $path       = 'images/file/';
            $image->move($path, $imageName);
            $imageUrl   = $path . $imageName;
            $galleries->cover_photo = $imageUrl;
            $galleries->flag = 'web_cover_photo';
        }

        if ($request->hasFile('photo')) {

            $image      = $request->file('photo');
            $imageName  = 'gallery_p'.date('ymdhis').'.'.$image->getClientOriginalExtension();
            $path       = 'images/file/';
            $image->move($path, $imageName);
            $imageUrl   = $path . $imageName;
            $galleries->photo = $imageUrl;
            $galleries->flag = 'web_cover_photo_two';
        }

        if ($request->hasFile('logo')){

            $image      = $request->file('logo');
            $imageName  = 'gallery_l'.date('ymdhis').'.'.$image->getClientOriginalExtension();
            $path       = 'images/file/';
            $image->move($path, $imageName);
            $imageUrl   = $path . $imageName;
            $galleries->logo = $imageUrl;
            $galleries->flag = 'logo';


        }



        $galleries->save();


        return redirect('admin/galleries')->withSuccess('সফলভাবে সেভ করা হয়েছে');

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

            $galleries = Gallery::find($id);

            $galleries->status = $request->status;
            $galleries->save();


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
        Gallery::destroy($id);
        return back()->withSuccess('সফলভাবে ডিলিট করা হয়েছে');
    }


}
