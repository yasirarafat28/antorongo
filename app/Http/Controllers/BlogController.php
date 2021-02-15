<?php

namespace App\Http\Controllers;

use App\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Blog::paginate('25');
        return view('admin.web-site.blog.index',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.web-site.blog.create');
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
            'title'=>'required',
        ]);

        $blogs = new Blog();
        $blogs->title = $request->title;
        $blogs->description = $request->description;
        $blogs->status = $request->status;

        if ($request->hasFile('feature_image')) {

            $image      = $request->file('feature_image');
            $imageName  = 'blogs_'.date('ymdhis').'.'.$image->getClientOriginalExtension();
            $path       = 'images/file/';
            $image->move($path, $imageName);
            $imageUrl   = $path . $imageName;
            $blogs->feature_image = $imageUrl;
        }

        $blogs->save();

        return redirect('/admin/blogs')->withSuccess('সফলভাবে সেভ করা হয়েছে');
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
        Blog::destroy($id);
        return back()->withSuccess('সফলভাবে মুছে ফেলা হয়েছে');
    }
}
