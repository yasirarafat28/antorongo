<?php

namespace App\Http\Controllers;

use App\Points;
use App\User;
use Illuminate\Http\Request;
use Auth;

class IDController extends Controller
{
    //

    public function get(Request $request)
    {

        if ($request->has('q')) {

            $query = $request->q;
            $user = User::where('unique_id',$request->q)->orWhere('email',$request->q)->orWhere('username',$request->q)->first();
        }
        else{
            $user ='';
            $query = '';
        }
        return view('chairman/id-print-search',compact('user','query'));
    }

    public function getUser(Request $request)
    {

        $user = Auth::user();
        return view('member/id-print',compact('user'));
    }
}
