<?php

namespace App\Http\Controllers;

use App\District;
use App\Division;
use App\Thana;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request)
    {

        $keyword = $request->get('search');

        $users = User::with('roles')
        ->whereHas('roles',function($q){
            $q->whereNotIn('name',['member']);
        })->where(function($q) use($keyword){
            if($keyword){
                $q->where('user_name', 'LIKE', "%$keyword%");

                $q->where('email', 'LIKE', "%$keyword%");
                $q->orWhere('phone_number', 'LIKE', "%$keyword%");

            }

        })
        ->paginate(25);

        $roles = Role::all();
        $divisions = Division::orderBy('name','ASC')->get();
        return view('admin/users/users',compact('roles','users','divisions'));
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

        $this->validate($request, [
            'email' => 'required|unique:users',
            'phone' => 'required|unique:users',
            'username' => 'required|unique:users',
            'role' => 'required',
            'password' => 'required',
        ]);
        $random_password = Hash::make($request->password);

        $user = new User();
        $user->unique_id = uniqid();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->phone = $request->phone;
        $user->password = $random_password;
        $user->role =$request->role;
        $user->save();

        $user->syncRoles($request->role);

        //All Image file

        if ($request->hasFile('photo')) {

            $image      = $request->file('photo');
            $imageName  = 'user_'.date('ymdhis').'.'.$image->getClientOriginalExtension();
            $path       = 'images/users/';
            $image->move($path, $imageName);
            $imageUrl   = $path . $imageName;
            $user->photo = $imageUrl ;
        }


        //Confirmation Email

        return back()->withSuccess('Member Joined Successfully');
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


        $this->validate($request, [
            'email' => 'required',
            'phone' => 'required',
            'username' => 'required',
        ]);


        $random_password = Hash::make($request->password);

        $user = User::find($id);
        $user->unique_id = uniqid();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->phone = $request->phone;
        $user->division = $request->division;
        $user->district = $request->district;
        $user->thana = $request->thana;
        $user->address = $request->address;
        $user->status = $request->status;

        $user->role =$request->role;
        $user->upline_1 = Auth::user()->id;
        $user->joined_by = Auth::user()->id;

        if ($request->has('password'))
        {
            $user->password = $random_password;
        }
        $user->save();

        $user->syncRoles($request->role);

        //All Image file

        if ($request->hasFile('photo')) {

            $image      = $request->file('photo');
            $imageName  = 'user_'.date('ymdhis').'.'.$image->getClientOriginalExtension();
            $path       = 'images/users/';
            $image->move($path, $imageName);
            $imageUrl   = $path . $imageName;
            $user->photo = $imageUrl ;
        }


        //Confirmation Email

        return back()->withSuccess('User Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return back()->withSuccess('User Deleted Successfully');
    }


    public function getUser(Request $request)
    {
        $user = User::find($request->user_id);
        return $user;
    }




    public function generateRandomString($length = 11)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;

    }


}
