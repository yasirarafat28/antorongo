<?php

namespace App\Http\Controllers;

use App\Saving;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    //

    public function saving($txn_id){
        $saving = Saving::where('txn_id',$txn_id)->first();
        if(!$saving){
            return back()->withErrors('No saving found!');
        }

        return view('invoice.saving',compact('saving'));

    }
}
