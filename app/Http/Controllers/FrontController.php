<?php

namespace App\Http\Controllers;

use App\Fdr;
use App\Loan;
use App\Saving;
use App\User;
use Illuminate\Http\Request;

class FrontController extends Controller
{

    public function member_search(Request $request){

        if ($request->has('q')) {

            $query = $request->q;
            $member = User::where('unique_id',$request->q)->orWhere('email',$request->q)->orWhere('phone',$request->q)->first();
            // L,FD,G,C,FM,

            $releted_query = array();

            if (strpos($query, 'L') !== false) {
                $releted_query[0] = str_replace('L', 'FD', $query);
                $releted_query[1] = str_replace('L', 'G', $query);
                $releted_query[2] = str_replace('L', 'C', $query);
                $releted_query[3] = str_replace('L', 'FM', $query);
            }elseif (strpos($query, 'FD') !== false) {
                $releted_query[0] = str_replace('FD', 'L', $query);
                $releted_query[1] = str_replace('FD', 'G', $query);
                $releted_query[2] = str_replace('FD', 'C', $query);
                $releted_query[3] = str_replace('FD', 'FM', $query);
            }elseif (strpos($query, 'G') !== false) {
                $releted_query[0] = str_replace('G', 'L', $query);
                $releted_query[1] = str_replace('G', 'FD', $query);
                $releted_query[2] = str_replace('G', 'C', $query);
                $releted_query[3] = str_replace('G', 'FM', $query);
            }elseif (strpos($query, 'C') !== false) {
                $releted_query[0] = str_replace('C', 'L', $query);
                $releted_query[1] = str_replace('C', 'FD', $query);
                $releted_query[2] = str_replace('C', 'G', $query);
                $releted_query[3] = str_replace('C', 'FM', $query);
            }elseif (strpos($query, 'FM') !== false) {
                $releted_query[0] = str_replace('FM', 'L', $query);
                $releted_query[1] = str_replace('FM', 'FD', $query);
                $releted_query[2] = str_replace('FM', 'G', $query);
                $releted_query[3] = str_replace('FM', 'C', $query);
            }

            if (sizeof($releted_query)<1) {
                $releted_user_ids = array();
            }else{

                $releted_user_ids = User::where('unique_id','like','%'.$releted_query[0].'%')->orWhere('unique_id','like','%'.$releted_query[1].'%')->orWhere('unique_id','like','%'.$releted_query[2].'%')->orWhere('unique_id','like','%'.$releted_query[3].'%')->orWhere('unique_id','like','%'.$query.'%')
                ->get('id')->pluck('id')->toArray();
            }


            if($member)
                array_push($releted_user_ids,$member->id);



            //return $releted_user_ids;



            $loan_records = Loan::with('user')->whereIn('user_id',$releted_user_ids)->get();

            $saving_records = Saving::with('user')->whereIn('user_id',$releted_user_ids)->get();
            $FDR_records = Fdr::with('user')->whereIn('user_id',$releted_user_ids)->get();
        }elseif ($request->has('id')) {

            $query = $request->id;
            $member = User::where('id',$request->id)->first();

            $loan_records = Loan::with('user')->where('user_id',$member->id)->get();

            $saving_records = Saving::with('user')->where('user_id',$member->id)->get();
            $FDR_records = Fdr::with('user')->where('user_id',$member->id)->get();
        }
        else{
            $member ='';
            $saving_records ='';
            $loan_records ='';
            $FDR_records ='';
            $query = '';
        }

        return view('front.member-find',compact('query','member','loan_records','saving_records','FDR_records'));
    }
}
