<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccessGeneratorController extends Controller
{
    //


    public function index(Request $request)
    {

        if ($request->has('q')) {

            $query = $request->q;
            $user = User::where('unique_id',$request->q)->orWhere('email',$request->q)->orWhere('username',$request->q)->first();
        }
        else{
            $user ='';
            $query = '';
        }

        //return $user;
        return view('chairman/user-password-generator',compact('user','query'));
    }

    public function generator($type,$user_id)
    {
        $user = User::find($user_id);
        if ($type=='username')
        {
            $random_username = uniqid();
            $user->username = $random_username;
            $user->save();
            //Send mail
            return back()->withSuccess('New Username Generated. Username: '.$random_username);
        }
        if ($type=='id')
        {
            $random_id = uniqid();
            $user->unique_id = $random_id;
            $user->save();
            //Send mail
            return back()->withSuccess('New ID Generated. ID : '.$random_id);
        }
        if ($type=='password')
        {
            $random_password = $this->generateRandomString(8);
            $user->password = Hash::make($random_password);
            $user->save();
            //Send mail
            return back()->withSuccess('New Password Generated. Password : '.$random_password);
        }
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
