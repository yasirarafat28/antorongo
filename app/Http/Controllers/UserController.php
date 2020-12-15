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
use Illuminate\Support\Facades\Auth as FacadesAuth;

class UserController extends Controller
{

    // function __construct()
    // {
    //     $this->middleware('permission:user-list', ['only' => ['index']]);
    //     $this->middleware('permission:user-create', ['only' => ['create','store']]);
    //     $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
    //     $this->middleware('permission:user-show', ['only' => ['show']]);
    //     $this->middleware('permission:user-delete', ['only' => ['destroy']]);


    // }
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
        ;
        if(isset($request->limit) && $request->limit=='-1'){
            $users = $users->paginate($users->count());
        }else{
            $users = $users->paginate(25);
        }

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
            'name'=>'required',
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
        $user->present_address = $request->address;
        $user->status = $request->status;
        $user->password = $random_password;
        $user->role =$request->role;
        $user->joined_by = Auth::user()->id;

        if ($request->hasFile('photo')) {

            $image      = $request->file('photo');
            $imageName  = 'user_'.date('ymdhis').'.'.$image->getClientOriginalExtension();
            $path       = 'images/users/';
            $image->move($path, $imageName);
            $imageUrl   = $path . $imageName;
            $user->photo = $imageUrl ;
        }

        $user->save();

        $user->syncRoles($request->role);

        //All Image file




        //Confirmation Email

        return back()->withSuccess('সদস্য সফলভাবে যোগদান করেছেন!');
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
            'name'=>'required',
            'email' => 'required',
            'phone' => 'required',
            'username' => 'required',
            'role' => 'required',
        ]);


        $random_password = Hash::make($request->password);

        $user = User::find($id);
        // $user->unique_id = uniqid();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->phone = $request->phone;
        // $user->division = $request->division;
        // $user->district = $request->district;
        // $user->thana = $request->thana;
        $user->present_address = $request->present_address;
        $user->status = $request->status;
        $user->role =$request->role;
        // $user->upline_1 = Auth::user()->id;
        $user->joined_by = Auth::user()->id;

        if ($request->has('password'))
        {
            $user->password = $random_password;
        }

        if ($request->hasFile('photo')) {

            $image      = $request->file('photo');
            $imageName  = 'user_'.date('ymdhis').'.'.$image->getClientOriginalExtension();
            $path       = 'images/users/';
            $image->move($path, $imageName);
            $imageUrl   = $path . $imageName;
            $user->photo = $imageUrl ;
        }

        $user->save();

        $user->syncRoles($request->role);

        //All Image file




        //Confirmation Email

        return back()->withSuccess('সদস্য সফলভাবে আপডেট হয়েছে');
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
        return back()->withSuccess('সদস্য সফলভাবে মোছা হয়েছে');
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
