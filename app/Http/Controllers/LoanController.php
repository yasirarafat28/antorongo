<?php

namespace App\Http\Controllers;

use App\DepositoryMember;
use App\DepositoryOrnament;
use App\DepositoryProperty;
use App\Loan;
use App\LoanTransaction;
use App\NumberConverter;
use App\Transaction;
use App\TransactionHead;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:loan-find', ['only' => ['LoanFind']]);
        $this->middleware('permission:loan-list', ['only' => ['LoanList']]);
        $this->middleware('permission:loan-edit', ['only' => ['LoanEdit','LoanUpdate']]);
        $this->middleware('permission:loan-show', ['only' => ['show']]);
        $this->middleware('permission:loan-delete', ['only' => ['DeleteLoan']]);
        $this->middleware('permission:loan-approve', ['only' => ['ApproveLoan']]);
        $this->middleware('permission:loan-reject', ['only' => ['RejectLoan']]);
        $this->middleware('permission:loan-close', ['only' => ['close']]);
        //$this->middleware('permission:laon-depository', ['only' => ['depository']]);
        $this->middleware('permission:loan-application', ['only' => ['LoanApplication','LoanApplicationSubmit']]);

    }

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

        return view('admin/loan/find',compact('query','loan'));
    }


    public function  LoanEdit($id)
    {
        $loan = Loan::with('user','PersonDepositors','PropertyDepositors','OrnamentDepositors')->where('id',$id)->first();

        $members = User::where('role','member')->orderBy('name','ASC')->get();

        return view('admin/loan/edit',compact('loan','members'));
    }

    public function  LoanUpdate(Request $request,$id)
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
        $records = Loan::with('user')->withCount(['PersonDepositors','PropertyDepositors','OrnamentDepositors'])->where(function ($q) use ($request){

            if ($request->has('from') && $request->from) {
                $from = date("Y-m-d", strtotime($request->from));
                $q->where('start_at', '>=',  $from);

            }
            if ($request->has('to') && $request->to) {

                $to = date("Y-m-d", strtotime($request->to));
                $q->where('start_at', '<=',  $to);

            }

            if ($request->has('filterBy') && $request->filterBy !='all') {
                $q->where('status', $request->filterBy);

            }

        });
        if($request->has('dipository') && $request->dipository){
            if($request->dipository=='person'){
                $records = $records->having('person_depositors_count','>',0);
            }elseif($request->dipository=='property'){
                $records = $records->having('property_depositors_count','>',0);
            }elseif($request->dipository=='ornament'){
                $records = $records->having('ornament_depositors_count','>',0);
            }

        }
        if(isset($request->limit) && $request->limit=='-1'){
            $records = $records->orderBy('created_at','DESC')->paginate($records->count());
        }else{
            $records = $records->orderBy('created_at','DESC')->paginate(25);
        }


        $total = Loan::withCount(['PersonDepositors','PropertyDepositors','OrnamentDepositors'])->where(function ($q) use ($request){

            if ($request->has('from') && $request->from) {
                $from = date("Y-m-d", strtotime($request->from));
                $q->where('start_at', '>=',  $from);

            }
            if ($request->has('to') && $request->to) {

                $to = date("Y-m-d", strtotime($request->to));
                $q->where('start_at', '<=',  $to);

            }

        });
        if($request->has('dipository') && $request->dipository){
            if($request->dipository=='person'){
                $total = $total->having('person_depositors_count','>',0);
            }elseif($request->dipository=='property'){
                $total = $total->having('property_depositors_count','>',0);
            }elseif($request->dipository=='ornament'){
                $total = $total->having('ornament_depositors_count','>',0);
            }

        }

        $total = $total->sum('approved_amount');



        $active_count   = Loan::where('status','active')->count();
        $pending_count   = Loan::where('status','pending')->count();
        $declined_count   = Loan::where('status','declined')->count();
        $closed_count   = Loan::where('status','closed')->count();

        return view('admin/loan/list',compact('records','active_count','pending_count','declined_count','closed_count','total'));
    }

    public function  LoanApplication(Request $request)
    {

        $members = User::where('role','member')->orderBy('name','ASC')->get();
        $records = Loan::with('user')->get();
        return view('admin/loan/application',compact('members'));
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
        $this->validate($request,[
            'approved_amount'=>'required',
            'duration'=>'required',
            'interest_rate'=>'required',
        ]);
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

        Transaction::where('transaction_for','loan')->where('transactable_id',$id)->delete();
        return redirect('admin/loan/list')->withSuccess('সফলভাবে মুছে ফেলা হয়েছে');
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

    public function depository($id){



        $loan = Loan::find($id);
        if(!$loan){
            return back()->withError('Not found');
        }

        return view('admin.loan.depository',compact('loan'));
    }




    public function close($id){


        $loan = Loan::find($id);
        if(!$loan){
            return back()->withError('Not found');
        }

        $loan->status='closed';
        $loan->save();

        return back()->withSuccess('সফলভাবে সদস্য পদ প্রত্যাহার করা হয়েছে!');
    }


    public function add_interest(Request $request){
        $this->validate($request,[
            'loan_id'=>'required',
            'amount'=>'required',
            'date'=>'required',
            'user_id'=>'required',
        ]);

        $transaction = new Transaction();
        $transaction->txn_id = uniqid();
        $transaction->transaction_for = 'loan';
        $transaction->transactable_id = $request->loan_id;
        $transaction->flag = 'add_interest';
        $transaction->type = 'expense';
        $transaction->head_id = 0;
        $transaction->user_id = $request->user_id;
        $transaction->note = $request->note;
        $transaction->date = $request->date;
        $transaction->amount = NumberConverter::bn2en($request->amount);
        $transaction->added_by = Auth::user()->id;
        $transaction->received_by = Auth::user()->id;
        $transaction->admin_status ='approved';
        $transaction->manager_status = 'approved';
        $transaction->status = 'approved';
        $transaction->canculatable='no';
        $transaction->save();
        return back()->withSuccess('সফলভাবে সেভ করা হয়েছে');
    }


    public function add_reveanue(Request $request){
        $this->validate($request,[
            'loan_id'=>'required',
            'amount'=>'required',
            'date'=>'required',
            'user_id'=>'required',
        ]);

        $transaction = new Transaction();
        $transaction->txn_id = uniqid();
        $transaction->transaction_for = 'loan';
        $transaction->transactable_id = $request->loan_id;
        $transaction->flag = 'revenue_add';
        $transaction->type = 'expense';
        $transaction->head_id = 0;
        $transaction->user_id = $request->user_id;
        $transaction->note = $request->note;
        $transaction->date = $request->date;
        $transaction->amount = NumberConverter::bn2en($request->amount);
        $transaction->added_by = Auth::user()->id;
        $transaction->received_by = Auth::user()->id;
        $transaction->admin_status ='approved';
        $transaction->manager_status = 'approved';
        $transaction->status = 'approved';
        $transaction->canculatable='no';
        $transaction->save();
        return back()->withSuccess('সফলভাবে সেভ করা হয়েছে');
    }


    public function collect_reveanue(Request $request){
        $this->validate($request,[
            'loan_id'=>'required',
            'amount'=>'required',
            'date'=>'required',
            'user_id'=>'required',
        ]);


        $head = TransactionHead::where('slug','loan_revenue_collect_income')->first();

        if(!$head){
            return back()->withError('Related head didn\'t found!');
        }

        $transaction = new Transaction();
        $transaction->txn_id = uniqid();
        $transaction->transaction_for = 'loan';
        $transaction->transactable_id = $request->loan_id;
        $transaction->flag = 'revenue_deduct';
        $transaction->type = 'income';
        $transaction->head_id = $head->id;
        $transaction->user_id = $request->user_id;
        $transaction->note = $request->note;
        $transaction->date = $request->date;
        $transaction->amount = NumberConverter::bn2en($request->amount);
        $transaction->added_by = Auth::user()->id;
        $transaction->received_by = Auth::user()->id;
        $transaction->admin_status ='approved';
        $transaction->manager_status = 'approved';
        $transaction->status = 'approved';
        $transaction->canculatable='yes';
        $transaction->save();


        if ($request->invoice)
        {
            return redirect('transaction-invoice/'.$transaction->txn_id);
        }

        return back()->withSuccess('সফলভাবে সেভ করা হয়েছে');
    }


    public function collect_interest(Request $request){
        $this->validate($request,[
            'loan_id'=>'required',
            'amount'=>'required',
            'date'=>'required',
            'user_id'=>'required',
        ]);


        $head = TransactionHead::where('slug','loan_profit_collect_income')->first();

        if(!$head){
            return back()->withError('Related head didn\'t found!');
        }

        $transaction = new Transaction();
        $transaction->txn_id = uniqid();
        $transaction->transaction_for = 'loan';
        $transaction->transactable_id = $request->loan_id;
        $transaction->flag = 'interest';
        $transaction->type = 'income';
        $transaction->head_id = $head->id;
        $transaction->user_id = $request->user_id;
        $transaction->note = $request->note;
        $transaction->date = $request->date;
        $transaction->amount = NumberConverter::bn2en($request->amount);
        $transaction->added_by = Auth::user()->id;
        $transaction->received_by = Auth::user()->id;
        $transaction->admin_status ='approved';
        $transaction->manager_status = 'approved';
        $transaction->status = 'approved';
        $transaction->canculatable='yes';
        $transaction->save();



        if ($request->invoice)
        {
            return redirect('transaction-invoice/'.$transaction->txn_id);
        }

        return back()->withSuccess('সফলভাবে সেভ করা হয়েছে');
    }


    public function collections(Request $request){

        $transactions = Transaction::with('user','receiver','loan')->where('transaction_for','loan')->whereIn('flag',['revenue_deduct','interest'])->where(function ($q) use ($request){

            if ($request->has('from') && $request->from) {
                $from = date("Y-m-d", strtotime($request->from));
                $q->where('date', '>=',  $from);

            }
            if ($request->has('to') && $request->to) {

                $to = date("Y-m-d", strtotime($request->to));
                $q->where('date', '<=',  $to);

            }

        });
        if(isset($request->limit) && $request->limit=='-1'){
            $transactions = $transactions->paginate($transactions->count());
        }else{
            $transactions = $transactions->paginate(25);
        }

        $total = Transaction::where('transaction_for','loan')
        ->whereIn('flag',['revenue_deduct','interest'])
        ->where(function ($q) use ($request){
            if ($request->has('from') && $request->from) {
                $from = date("Y-m-d", strtotime($request->from));
                $q->where('date', '>=',  $from);

            }
            if ($request->has('to') && $request->to) {

                $to = date("Y-m-d", strtotime($request->to));
                $q->where('date', '<=',  $to);

            }

        })
        ->sum('amount');

        return view('admin/loan/collection-report',compact('transactions','total'));


    }


    public function give_away(Request $request){

        $this->validate($request,[
            'loan_id'=>'required',
            'amount'=>'required',
            'date'=>'required',
        ]);

        $loan = Loan::find($request->loan_id);

        $head = TransactionHead::where('slug','loan_giving_expense')->first();

        if(!$head){
            return back()->withError('Related head didn\'t found!');
        }

        $transaction = Transaction::where('transaction_for','loan')
        ->where('transactable_id',$loan->id)
        ->where('flag','give_away')->first();

        if(!$transaction){
            $transaction = new Transaction();
        }


        $transaction = new Transaction();
        $transaction->txn_id = uniqid();
        $transaction->transaction_for = 'loan';
        $transaction->transactable_id = $loan->id;
        $transaction->flag = 'give_away';
        $transaction->type = 'expense';
        $transaction->head_id = $head->id;
        $transaction->user_id = $loan->user_id;
        $transaction->note = $request->note;
        $transaction->date = $request->date;
        $transaction->amount = NumberConverter::bn2en($request->amount);
        $transaction->added_by = Auth::user()->id;
        $transaction->received_by = Auth::user()->id;
        $transaction->admin_status ='approved';
        $transaction->manager_status = 'approved';
        $transaction->status = 'approved';
        $transaction->canculatable='yes';
        $transaction->save();


        if ($request->invoice)
        {
            return redirect('transaction-invoice/'.$transaction->txn_id);
        }

        return back()->withSuccess('ঋণ প্রদান সফলভাবে সেভ করা হয়েছে!');


    }
}
