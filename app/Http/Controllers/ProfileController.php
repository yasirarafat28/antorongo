<?php

namespace App\Http\Controllers;

use App\Activity;
use App\District;
use App\Division;
use App\Thana;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    //



    public function IndividualProfile(Request $request)
    {
        if ($request->has('q')) {

            $query = $request->q;
            $user = User::where('unique_id',$request->q)->orWhere('email',$request->q)->orWhere('username',$request->q)->first();


            $added_member = User::where('upline_1',$user->id)->count();
            $members = User::where('upline_1',$user->id)->orderBy('id','DESC')->get();
            $activities = Activity::where('user_id',$user->id)->orderBy('id','DESC')->get();
        }
        else{
            $user ='';
            $added_member ='';
            $query = '';
            $activities = '';
            $members = '';
        }
        return view('chairman/member-profile-search',compact('user','members','activities','added_member','query'));
    }

    public function profile($id)
    {
        $user = User::find($id);

        $added_member = User::where('upline_1',$user->id)->count();
        $members = User::where('upline_1',$id)->orderBy('id','DESC')->get();
        $activities = Activity::where('user_id',$id)->orderBy('id','DESC')->get();
        return view('chairman.member-profile',compact('user','members','activities','added_member'));

    }

    public function MyProfile(Request $request)
    {
        $id = Auth::id();
        $user = User::find($id);
        //Division,District/Thana
        // $divisions = Division::orderBy('name','ASC')->get();
        // if ($user->division){
        //     $districts=  District::where('division_id',$user->division)->orderBy('name','ASC')->get();
        // }
        // else{
        //     $districts = array();
        // }
        // if ($user->district){
        //     $thanas=  Thana::where('district_id',$user->district)->orderBy('name','ASC')->get();
        // }else{
        //     $thanas = array();
        // }

        //End of Division,District/Thana

        //$added_member = User::where('upline_1',Auth::user()->id)->count();
        //$members = User::where('upline_1',$id)->orderBy('id','DESC')->get();


        //$activities = Activity::with('user')->where('user_id',Auth::user()->id)->orderBy('id','DESC');

        return view('admin.profile',compact('user'));

    }

    public function  profileUpdate(Request $request)
    {
        $user_id = $request->user_id;
        $user = User::find($user_id);

        if ($request->has('name')) {
            $user->name = $request->name;
        }
        if ($request->has('name_bn')) {
            $user->name_bn = $request->name_bn;
        }
        // if ($request->has('username')) {
        //     $user->username = $request->username;
        // }
        if ($request->has('email')) {
            $user->email = $request->email;
        }
        if ($request->has('phone')) {
            $user->phone = $request->phone;
        }

        if ($request->has('phone_2')) {
            $user->phone_2 = $request->phone_2;
        }

        if ($request->has('dob')) {
            $user->dob = $request->dob;
        }

        if ($request->has('blood_group')) {
            $user->blood_group = $request->blood_group;
        }

        if ($request->has('present_address')) {
            $user->present_address = $request->present_address;
        }
        if ($request->has('permanent_address')) {
            $user->permanent_address = $request->permanent_address;
        }
        // if ($request->has('comment')) {
        //     $user->comment = $request->comment;
        // }


        // if ($request->has('father_name')) {
        //     $user->father_name = $request->father_name;
        // }
        // if ($request->has('education_qualification')) {
        //     $user->education_qualification = $request->education_qualification;
        // }


        //Address Information


        // if ($request->has('division')) {
        //     $user->division = $request->division ?? 0 ;
        // }
        // if ($request->has('district')) {
        //     $user->district = $request->district ?? 0 ;
        // }
        // if ($request->has('thana')) {
        //     $user->thana = $request->thana ?? 0 ;
        // }

        //Nominee's information
        // if ($request->has('nominee_name')) {
        //     $user->nominee_name = $request->nominee_name;
        // }
        // if ($request->has('nominee_phone')) {
        //     $user->nominee_phone = $request->nominee_phone;
        // }
        // if ($request->has('nominee_email')) {
        //     $user->nominee_email = $request->nominee_email;
        // }
        // if ($request->has('nominee_dob')) {
        //     $user->nominee_dob = $request->nominee_dob;
        // }
        // if ($request->has('nominee_relation')) {
        //     $user->nominee_relation = $request->nominee_relation;
        // }

        //All Image file

        if ($request->hasFile('photo')) {

            $image      = $request->file('photo');
            $imageName  = 'user_'.date('ymdhis').'.'.$image->getClientOriginalExtension();
            $path       = 'images/users/';
            $image->move($path, $imageName);
            $imageUrl   = $path . $imageName;
            $user->photo = $imageUrl ;
        }

        // if ($request->hasFile('signature')) {

        //     $image      = $request->file('signature');
        //     $imageName  = 'user_signature_'.date('ymdhis').'.'.$image->getClientOriginalExtension();
        //     $path       = 'images/users/';
        //     $image->move($path, $imageName);
        //     $imageUrl   = $path . $imageName;
        //     $user->signature = $imageUrl ;
        // }

        // if ($request->hasFile('nominee_photo')) {

        //     $image      = $request->file('nominee_photo');
        //     $imageName  = 'user_nominee_'.date('ymdhis').'.'.$image->getClientOriginalExtension();
        //     $path       = 'images/users/';
        //     $image->move($path, $imageName);
        //     $imageUrl   = $path . $imageName;
        //     $user->nominee_photo = $imageUrl ;
        // }

        // if ($request->hasFile('nominee_signature')) {

        //     $image      = $request->file('nominee_signature');
        //     $imageName  = 'user_nominee_'.date('ymdhis').'.'.$image->getClientOriginalExtension();
        //     $path       = 'images/users/';
        //     $image->move($path, $imageName);
        //     $imageUrl   = $path . $imageName;
        //     $user->nominee_signature = $imageUrl ;
        // }

        $user->save();
        return back()->withSuccess('প্রোফাইল তথ্য সফলভাবে আপডেট হয়েছে!');
    }

    public function change_password(Request $request){
        $user_id = $request->user_id;

        $user = User::find($user_id);
        $this->validate($request, [
            'old_password' => 'required',
            'new_password' => 'required|string|min:4|different:old_password',
            'confirm_password' => 'required|same:new_password',
        ],
            [
                'new_password.different' => 'আপনাকে পুরানো পাসওয়ার্ডের চেয়ে আলাদা পাসওয়ার্ড রাখতে হবে',
            ]

        );
        if ((Hash::check($request['old_password'], $user->password)) == 1){

            User::where('id',$user->id)->update([
                'password' => Hash::make($request->new_password),
            ]);
            return back()->withSuccess('পাসওয়ার্ড সফলভাবে পরিবর্তিত হয়েছে');
        }else{
            return back()->withErrors('আপনার বর্তমান পাসওয়ার্ডটি ভুল');
        }


    }
}
