<?php

namespace App\Http\Controllers;

use App\Fdr;
use App\Loan;
use App\Saving;
use App\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request){
        $query = $request->q;
        if(!$query){
            return view('admin.search',compact('query'));
        }


        $member = User::where('unique_id',$query)->orWhere('email',$query)->orWhere('phone',$query)->first();
        if($member){
            return redirect('admin/members/find?q='.$query);
        }

        $fdr = Fdr::with('user','receiver')->where('txn_id',$query)->first();
        if($fdr){
            return redirect('admin/fdr/find?q='.$query);
        }

        $fdr = Fdr::with('user','receiver')->where('txn_id',$query)->first();
        if($fdr){
            return redirect('admin/fdr/find?q='.$query);
        }

        $loan = Loan::with('user','PersonDepositors','PropertyDepositors','OrnamentDepositors')->where('unique_id',$query)->first();
        if($loan){
            return redirect('admin/loan/find?q='.$query);
        }


        $saving = Saving::with('user')->where('txn_id',$query)->first();
        if($saving){
            return redirect('admin/saving/find?q='.$query);
        }


        return view('admin.search',compact('query'));
    }
}
