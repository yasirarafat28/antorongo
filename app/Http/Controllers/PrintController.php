<?php

namespace App\Http\Controllers;

use App\Fdr;
use App\Loan;
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
    //

    public function fdr($txn_id){
        $fdr = Fdr::where('txn_id',$txn_id)->first();
        if(!$fdr){
            return back()->withErrors('No FDR found!');
        }

        return view('invoice.fdr',compact('fdr'));

    }

    public function loan($txn_id){
        $loan = Loan::where('unique_id',$txn_id)->first();
        if(!$loan){
            return back()->withErrors('No Loan found!');
        }

        return view('invoice.loan',compact('loan'));

    }
}
