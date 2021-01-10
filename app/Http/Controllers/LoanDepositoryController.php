<?php

namespace App\Http\Controllers;

use App\DepositoryMember;
use App\DepositoryOrnament;
use App\DepositoryProperty;
use App\Loan;
use Illuminate\Http\Request;

class LoanDepositoryController extends Controller
{
    public function add_depository(Request $request){

        $this->validate($request,[
            'loan_id'=>'required',
            'type'=>'required|in:person,ornament,property'
        ]);

        $loan = Loan::find($request->loan_id);

        if($request->type=='person'){
            // $this->validate($request,[
            //     'depository_unique_id'=>'required',
            //     'depository_description'=>'required',
            //     'depository_total_amount'=>'required',
            // ]);

            $person_depository = new DepositoryMember();
            $person_depository->loan_id = $loan->id;
            $person_depository->description = $request->depository_description;
            $person_depository->unique_id = $request->depository_unique_id;
            $person_depository->policy_amount = $request->depository_total_amount;
            $person_depository->save();

        }
        elseif($request->type=='ornament'){

            // $this->validate($request,[
            //     'o_depository_total_price'=>'required',
            //     'o_depository_qty'=>'required',
            //     'o_depository_unique_id'=>'required',
            // ]);

            $person_depository = new DepositoryOrnament();
                $person_depository->loan_id = $loan->id;
                $person_depository->description = $request->o_depository_description;
                $person_depository->unique_id = $request->o_depository_unique_id;
                // $person_depository->qty = $request->o_depository_qty;
                // $person_depository->unit_price = $request->o_depository_unit_price;
                // $person_depository->total_amount = $request->o_depository_total_price;
                $person_depository->status = 'active';
                $person_depository->save();

        }elseif($request->type=='property'){

            // $this->validate($request,[
            //     'p_position'=>'required',
            //     'p_total_amount'=>'required',
            //     'p_qty'=>'required',
            // ]);

            $property_depository = new DepositoryProperty();
            $property_depository->loan_id = $loan->id;
            //$property_depository->unique_id = $request->unique_id;
            $property_depository->position = $request->p_position;
            $property_depository->mouja = $request->p_mouja;
            $property_depository->dag = $request->p_dag;
            $property_depository->khotiyan = $request->p_khotiyan;
            $property_depository->holding = $request->p_holding;
            $property_depository->description = $request->description;
            $property_depository->qty = $request->p_qty;
            $property_depository->total_amount = $request->p_total_amount;
            $property_depository->save();

        }

        return back()->withSuccess('সফলভাবে সেভ করা হয়েছে!');



    }

    public function delete_depository ($type,$id){

        if($type=='person'){
            DepositoryMember::destroy($id);

        }
        elseif($type=='ornament'){
            DepositoryOrnament::destroy($id);

        }
        elseif($type=='property'){
            DepositoryProperty::destroy($id);

        }


        return back()->withSuccess('সফলভাবে মুছে ফেলা হয়েছে!');


    }
}
