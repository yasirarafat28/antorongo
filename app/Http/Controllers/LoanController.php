<?php

namespace App\Http\Controllers;

use App\DepositoryMember;
use App\DepositoryOrnament;
use App\DepositoryProperty;
use App\Loan;
use App\LoanTransaction;
use App\NumberConverter;
use Illuminate\Http\Request;
use App\User;

class LoanController extends Controller
{
    //

    public function  LoanFind(Request $request)
    {

        if ($request->has('id')) {

            $loan = Loan::with('user','PersonDepositors','PropertyDepositors','OrnamentDepositors')->where('id',$request->id)->first();

            $query = $loan->unique_id??'';
        }elseif ($request->has('q')) {

            $query = $request->q;
            $loan = Loan::with('user','PersonDepositors','PropertyDepositors','OrnamentDepositors')->where('unique_id',$request->q)->first();
        }
        else{
            $loan ='';
            $query = '';
        }

        if($loan){

            $transactions = LoanTransaction::with('user','receiver')->where('loan_id',$loan->id)->orderBy('id','DESC')->get();
        }else{
            $transactions = '';

        }
        return view('admin/loan-find',compact('query','loan','transactions'));
    }


    public function  LoanEdit($id)
    {
        $loan = Loan::with('user','PersonDepositors','PropertyDepositors','OrnamentDepositors')->where('id',$id)->first();

        $members = User::where('role','member')->orderBy('name','ASC')->get();

        return view('admin/loan-edit',compact('query','loan','transactions','members'));
    }

    public function  LoanUpdate($id)
    {
        //return $request;
        $this->validate($request,
            [
                'user_id' => 'required',
            ]
        );


        $member = User::find($request->user_id);    

        //Update Loan

        $loan = Loan::find($id);
        $loan->unique_id = $request->loan_code;
        $loan->user_id = $member->id;
        $loan->reason = $request->reason;
        $loan->request_amount = NumberConverter::bn2en($request->request_amount??0);
        $loan->approved_amount = NumberConverter::bn2en($request->approved_amount??0);
        $loan->installment_amount = NumberConverter::bn2en($request->installment_amount??0);
        $loan->duration = NumberConverter::bn2en($request->duration??0);
        $loan->interest_rate = NumberConverter::bn2en($request->interest_rate??0);
        $loan->start_at = $request->date;
        $loan->installment_type = $request->installment_type;
        $loan->save();



        //Person Depository
        for ($i=0;$i<sizeof($request->depository_unique_id);$i++)
        {
            if (!empty($request->depository_unique_id[$i]) && !empty($request->depository_description[$i]) && !empty($request->depository_total_amount[$i])){
                $person_depository = DepositoryMember::find($request->depository_id[$i]);
                $person_depository->loan_id = $loan->id;
                $person_depository->description = $request->depository_description[$i];
                $person_depository->unique_id = $request->depository_unique_id[$i];
                $person_depository->policy_amount = $request->depository_total_amount[$i];
                $person_depository->save();
            }
        }

        //Ornament Depository
        for ($i=0;$i<sizeof($request->o_depository_unique_id);$i++)
        {
            if (!empty($request->o_depository_unique_id[$i]) && !empty($request->o_depository_qty[$i]) && !empty($request->o_depository_total_price[$i])){
                $person_depository = DepositoryOrnament::find($request->o_id[$i]);
                $person_depository->loan_id = $loan->id;
                $person_depository->description = $request->o_depository_description[$i];
                $person_depository->unique_id = $request->o_depository_unique_id[$i];
                $person_depository->qty = $request->o_depository_qty[$i];
                $person_depository->unit_price = $request->o_depository_unit_price[$i];
                $person_depository->total_amount = $request->o_depository_total_price[$i];
                $person_depository->status = 'active';
                $person_depository->save();
            }
        }


        //Property Depository
        for ($i=0;$i<sizeof($request->p_position);$i++)
        {
            if (!empty($request->p_position[$i]) && !empty($request->p_total_amount[$i]) && !empty($request->p_qty[$i])){
                $property_depository = DepositoryProperty::find($request->p_id[$i]);
                $property_depository->loan_id = $loan->id;
                $property_depository->position = $request->p_position[$i];
                $property_depository->mouja = $request->p_mouja[$i];
                $property_depository->dag = $request->p_dag[$i];
                $property_depository->khotiyan = $request->p_khotiyan[$i];
                $property_depository->holding = $request->p_holding[$i];
                $property_depository->description = $request->description[$i];
                $property_depository->qty = $request->p_qty[$i];
                $property_depository->total_amount = $request->p_total_amount[$i];
                $property_depository->save();
            }
        }

        return back()->withSuccess('সফলভাবে সেভ করা হয়েছে');
    }

    public  function LoanList(Request $request)
    {
        $records = Loan::with('user','transactions')->where(function ($q) use ($request){

            if ($request->has('from') && $request->from) {
                $from = date("Y-m-d", strtotime($request->from));
                $q->where('start_at', '>=',  $from);

            }
            if ($request->has('to') && $request->to) {

                $to = date("Y-m-d", strtotime($request->to));
                $q->where('start_at', '<=',  $to);

            }

        })->get();
        return view('admin/loan-list',compact('records'));
    }

    public function  LoanApplication(Request $request)
    {

        $members = User::where('role','member')->orderBy('name','ASC')->get();
        $records = Loan::with('user')->get();
        return view('admin/loan-application',compact('members'));
    }

    public function  LoanApplicationSubmit(Request $request)
    {


        //return $request;
        $this->validate($request,
            [
                'user_id' => 'required',
            ]
        );

        //User Fetch
        if ($request->user_id=='no'){

            $this->validate($request,
                [
                    'name' => 'required',
                    'name_bn' => 'required',
                    'phone' => 'required',
                    'present_address' => 'required',
                ],
                [
                    'name_bn.required' => 'অবশ্যই বাংলায় নাম বসাতে হবে!',
                    'name.required' => 'অবশ্যই  ইংরেজীতে নাম বসাতে হবে!',
                    'phone.required' => 'অবশ্যই মোবাইল নাম্বার বসাতে হবে!',
                ]
            );
            $random_account = uniqid();
            $random_email = uniqid().'temporaryemail@ontorongo.com';
            $random_password = bcrypt('12345678');

            $member = new User();
            $member->role = 'member';

            if ($request->has('name')){ $member->name = $request->name;}
            if ($request->has('name_bn')){ $member->name_bn = $request->name_bn;}
            if ($request->has('share_holder_name')){ $member->share_holder_name = $request->share_holder_name;}
            if ($request->has('father_name')){ $member->father_name = $request->father_name;}
            if ($request->has('mother_name')){ $member->mother_name = $request->mother_name;}
            if ($request->has('dob')){ $member->dob = date("Y-m-d H:i:s", strtotime($request->dob));}
            if ($request->has('nationality')){ $member->nationality = $request->nationality;}
            if ($request->has('nid')){ $member->nid = $request->nid;}
            if ($request->has('occupation')){ $member->occupation = $request->occupation;}
            if ($request->has('company_name')){ $member->company_name = $request->company_name;}
            if ($request->has('present_address')){ $member->present_address = $request->present_address;}
            if ($request->has('permanent_address')){ $member->permanent_address = $request->permanent_address;}
            if ($request->has('phone')){ $member->phone = $request->phone;}
            if ($request->has('phone_2')){ $member->phone_2 = $request->phone_2;}
            if ($request->has('comment')){ $member->comment = $request->comment;}
            if ($request->has('contact_address')){ $member->contact_address = $request->contact_address;}
            if ($request->has('nominee_name')){ $member->nominee_name = $request->nominee_name;}
            if ($request->has('nominee_father_name')){ $member->nominee_father_name = $request->nominee_father_name;}
            if ($request->has('nominee_present_address')){ $member->nominee_present_address = $request->nominee_present_address;}
            if ($request->has('nominee_permanent_address')){ $member->nominee_permanent_address = $request->nominee_permanent_address;}
            if ($request->has('nominee_share')){ $member->nominee_share = $request->nominee_share;}
            if ($request->has('nominee_relation')){ $member->nominee_relation = $request->nominee_relation;}
            if ($request->has('nominee_age')){ $member->nominee_age = $request->nominee_age;}

            if ($request->has('account_type')){ $member->account_type = $request->account_type;}
            if ($request->has('project')){ $member->project = $request->project;}

            if ($request->has('email')){ $member->email = $request->email;}else{$member->email = $random_email;}
            if ($request->unique_id){ $member->unique_id = $request->unique_id;}else{$member->unique_id = $random_account;}
            if ($request->has('password')){ $member->password = $request->password;}else{$member->password = $random_password;}

            //All Image file

            if ($request->hasFile('photo')) {

                $image      = $request->file('photo');
                $imageName  = 'member_'.date('ymdhis').'.'.$image->getClientOriginalExtension();
                $path       = 'images/member/';
                $image->move($path, $imageName);
                $imageUrl   = $path . $imageName;
                $member->photo = $imageUrl ;
            }

            if ($request->hasFile('signature')) {

                $image      = $request->file('signature');
                $imageName  = 'member_signature_'.date('ymdhis').'.'.$image->getClientOriginalExtension();
                $path       = 'images/member/';
                $image->move($path, $imageName);
                $imageUrl   = $path . $imageName;
                $member->signature = $imageUrl ;
            }

            if ($request->hasFile('nominee_photo')) {

                $image      = $request->file('nominee_photo');
                $imageName  = 'member_nominee_'.date('ymdhis').'.'.$image->getClientOriginalExtension();
                $path       = 'images/member/';
                $image->move($path, $imageName);
                $imageUrl   = $path . $imageName;
                $member->nominee_photo = $imageUrl ;
            }

            if ($request->hasFile('nominee_signature')) {

                $image      = $request->file('nominee_signature');
                $imageName  = 'member_nominee_'.date('ymdhis').'.'.$image->getClientOriginalExtension();
                $path       = 'images/member/';
                $image->move($path, $imageName);
                $imageUrl   = $path . $imageName;
                $member->nominee_signature = $imageUrl ;
            }

            $member->save();

            $member->assignRole('member');
        }
        else{
            $member = User::find($request->user_id);
        }
        //User Fetch End

        //Create Loan
        if ($request->has('loan_code'))
        {
            $loan_code = $request->loan_code;
        }else
            $loan_code = uniqid();
        $loan = new Loan();
        $loan->unique_id = $loan_code;
        $loan->user_id = $member->id;
        $loan->reason = $request->reason;
        $loan->request_amount = NumberConverter::bn2en($request->request_amount??0);
        $loan->approved_amount = NumberConverter::bn2en($request->approved_amount??0);
        $loan->installment_amount = NumberConverter::bn2en($request->installment_amount??0);
        $loan->duration = NumberConverter::bn2en($request->duration??0);
        $loan->interest_rate = NumberConverter::bn2en($request->interest_rate??0);
        $loan->start_at = $request->date;
        //$loan->closed_at = $request->unique_id;
        $loan->installment_type = $request->installment_type;
        $loan->status = 'pending';
        $loan->save();



        //Person Depository
        for ($i=0;$i<sizeof($request->depository_unique_id);$i++)
        {
            if (!empty($request->depository_unique_id[$i]) && !empty($request->depository_description[$i]) && !empty($request->depository_total_amount[$i])){
                $person_depository = new DepositoryMember();
                $person_depository->loan_id = $loan->id;
                $person_depository->description = $request->depository_description[$i];
                $person_depository->unique_id = $request->depository_unique_id[$i];
                $person_depository->policy_amount = $request->depository_total_amount[$i];
                $person_depository->save();
            }
        }

        //Ornament Depository
        for ($i=0;$i<sizeof($request->o_depository_unique_id);$i++)
        {
            if (!empty($request->o_depository_unique_id[$i]) && !empty($request->o_depository_qty[$i]) && !empty($request->o_depository_total_price[$i])){
                $person_depository = new DepositoryOrnament();
                $person_depository->loan_id = $loan->id;
                $person_depository->description = $request->o_depository_description[$i];
                $person_depository->unique_id = $request->o_depository_unique_id[$i];
                $person_depository->qty = $request->o_depository_qty[$i];
                $person_depository->unit_price = $request->o_depository_unit_price[$i];
                $person_depository->total_amount = $request->o_depository_total_price[$i];
                $person_depository->status = 'active';
                $person_depository->save();
            }
        }


        //Property Depository
        for ($i=0;$i<sizeof($request->p_position);$i++)
        {
            if (!empty($request->p_position[$i]) && !empty($request->p_total_amount[$i]) && !empty($request->p_qty[$i])){
                $property_depository = new DepositoryProperty();
                $property_depository->loan_id = $loan->id;
                //$property_depository->unique_id = $request->unique_id[$i];
                $property_depository->position = $request->p_position[$i];
                $property_depository->mouja = $request->p_mouja[$i];
                $property_depository->dag = $request->p_dag[$i];
                $property_depository->khotiyan = $request->p_khotiyan[$i];
                $property_depository->holding = $request->p_holding[$i];
                $property_depository->description = $request->description[$i];
                $property_depository->qty = $request->p_qty[$i];
                $property_depository->total_amount = $request->p_total_amount[$i];
                $property_depository->save();
            }
        }

        return back()->withSuccess('সফলভাবে অ্যাপ্লিকেশনটি সেভ করা হয়েছে');
    }

    public function ApproveLoan(Request $request,$id)
    {
        $loan = Loan::find($id);
        $loan->approved_amount = $request->approved_amount;
        $loan->duration = $request->duration;
        $loan->interest_rate = $request->interest_rate;
        $loan->status = 'active';
        $loan->save();
        return back()->withSuccess('সফলভাবে সেভ করা হয়েছে');
    }

    public function RejectLoan($id)
    {
        $loan = Loan::find($id);
        $loan->status = 'rejected';
        $loan->save();
        return back()->withSuccess('সফলভাবে সেভ করা হয়েছে');
    }

    public function DeleteLoan($id)
    {
        $loan = Loan::destroy($id);
        return back()->withSuccess('সফলভাবে মুছে ফেলা হয়েছে');
    }




    public function getLoansByUser(Request $request)
    {


        $records = Loan::with('user')->where('user_id',$request->user_id)->get();
        return $records;
    }
    public function getLoanDetails(Request $request)
    {


        $records = Loan::with('user')->where('id',$request->loan_id)->first();
        return $records;
    }

}
