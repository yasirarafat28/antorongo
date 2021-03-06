<?php

namespace App\Http\Controllers;

use App\NumberConverter;
use App\Saving;
use App\SavingPackage;
use App\SavingTransaction;
use App\Transaction;
use App\TransactionHead;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SavingController extends Controller
{

    // function __construct()
    // {
    //     $this->middleware('permission:saving-application', ['only' => ['application','SavingApplication','SavingDailyApplication','SavingCurrentApplication']]);
    //     $this->middleware('permission:saving-short-approve', ['only' => ['AdminApprove']]);
    //     $this->middleware('permission:saving-short-decline', ['only' => ['AdminDecline']]);
    //     $this->middleware('permission:saving-short-close', ['only' => ['SavingClose']]);
    //     $this->middleware('permission:saving-short-edit', ['only' => ['SavingEdit','SavingUpdate']]);
    //     $this->middleware('permission:saving-short-list', ['only' => ['getList']]);
    //     $this->middleware('permission:saving-find', ['only' => ['find']]);
    //     $this->middleware('permission:saving-short-collection-report-list', ['only' => ['CollectionList']]);
    //     $this->middleware('permission:saving-short-withdraw-report-list', ['only' => ['WithdrawList']]);

    // }

    public  function application($type)
    {
        $packages = SavingPackage::where('type',$type)->get();
        $members = User::where('role','member')->orderBy('name','ASC')->get();
        if ($type=='daily')
        {
            return view('admin/saving/daily-application',compact('members','type','packages'));
        }elseif ($type=='current')
        {
            return view('admin/saving/current-application',compact('members','type'));
        }else
            return view('admin/saving/application',compact('members','type','packages'));
    }

    public  function find(Request $request)
    {

        if ($request->has('id')) {

            $saving = Saving::with('user')->where('id',$request->id)->first();

            $query = $saving->txn_id;
        }elseif ($request->has('q')) {

            $query = $request->q;

            $saving = Saving::with('user','histories')->where('txn_id',$request->q)->first();
        }
        else{
            $saving ='';
            $query = '';
        }




        return view('admin/saving/find',compact('saving','query'));
    }

    public function Withdraw(Request $request)
    {

        $this->validate($request,[
            'saving_id'=>'required',
            'user_id'=>'required',
            'amount'=>'required',
            'date'=>'required',
            'balance'=>'required|in:profit,deposit',
        ]);



        $saving = Saving::find($request->saving_id);

        if(!$saving){
            return back()->withError('Related saving didn\'t found!');
        }

        // if($request->balance=='profit'){

        //     if($saving->profit_balance() < $request->amount){
        //         return back()->withErrors('দুঃখিত ! উত্তোলন করার জন্য যথেষ্ট পরিমান ব্যালেন্স নেই!');
        //     }

        // }elseif($request->balance=='deposit'){

        //     if($saving->deposit_balance() < $request->amount){
        //         return back()->withErrors('দুঃখিত ! উত্তোলন করার জন্য যথেষ্ট পরিমান ব্যালেন্স নেই!');
        //     }

        // }else{

        // //if($saving->balance() < $request->amount){
        //     return back()->withErrors('দুঃখিত ! উত্তোলন করার জন্য যথেষ্ট পরিমান ব্যালেন্স নেই!');
        // }

        if($saving->type=='long'){
            if($request->balance=='profit'){
                $flag = 'saving_project_10_profit_expense';

            }else{
                $flag = 'saving_project_10_expense';
            }
        }elseif($saving->type=='short'){
            if($request->balance=='profit'){
                $flag = 'saving_project_5_profit_expense';

            }else{
                $flag = 'saving_project_5_expense';
            }
        }elseif($saving->type=='current'){
            if($request->balance=='profit'){
                $flag = 'saving_general_profit_expense';

            }else{
                $flag = 'general_saving_refund_expense';
            }
        }else{
            if($request->balance=='profit'){
                $flag = 'daily_saving_profit_expense';

            }else{
                $flag = 'daily_saving_expense';
            }
        }
        $head = TransactionHead::where('slug',$flag)->first();

        if(!$head){
            return back()->withErrors('Related head didn\'t found!');
        }
        $transaction = new Transaction();
        $transaction->txn_id = uniqid();
        $transaction->transaction_for = 'saving';
        $transaction->transactable_id = $request->saving_id;
        $transaction->flag =  $request->balance=='profit'?'profit_withdraw':'deposit_withdraw';
        $transaction->type = 'expense';
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
        if (env('PREVIOUS_DATA_ENTRY','no')=='yes'){

            $transaction->canculatable = $request->canculatable;
        }
        $transaction->save();

        if ($request->invoice)
        {
            return redirect('transaction-invoice/'.$transaction->txn_id);
        }
        return back()->withSuccess('সফলভাবে সেভ করা হয়েছে');



    }

    public function Deposit(Request $request)
    {

        $this->validate($request,[
            'saving_id'=>'required',
            'user_id'=>'required',
            'amount'=>'required',
            'date'=>'required',
        ]);



        $saving = Saving::find($request->saving_id);

        if(!$saving){
            return back()->withError('Related saving didn\'t found!');
        }

        if($saving->type=='long'){
            $flag = 'saving_project_10_income';
        }elseif($saving->type=='short'){
            $flag = 'saving_project_5_income';
        }elseif($saving->type=='current'){
            $flag = 'general_saving_income';
        }else{
            $flag = 'daily_saving_collection_income';
        }
        $head = TransactionHead::where('slug',$flag)->first();

        if(!$head){
            return back()->withError('Related head didn\'t found!');
        }
        $transaction = new Transaction();
        $transaction->txn_id = uniqid();
        $transaction->transaction_for = 'saving';
        $transaction->transactable_id = $request->saving_id;
        $transaction->flag = 'deposit';
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
        if (env('PREVIOUS_DATA_ENTRY','no')=='yes'){

            $transaction->canculatable = $request->canculatable;
        }

        $transaction->save();

        if ($request->invoice)
        {
            return redirect('transaction-invoice/'.$transaction->txn_id);
        }
        return back()->withSuccess('সফলভাবে সেভ করা হয়েছে');
    }

    public function ManualProfit(Request $request)
    {

        $this->validate($request,[
            'saving_id'=>'required',
            'amount'=>'required',
            'note'=>'required',
            'amount'=>'required',
        ]);

        // $head = TransactionHead::where('slug','saving_project_5_income')->first();

        // if(!$head){
        //     return back()->withError('Related head didn\'t found!');
        // }

        $transaction = new Transaction();
        $transaction->txn_id = uniqid();
        $transaction->transaction_for = 'saving';
        $transaction->transactable_id = $request->saving_id;
        $transaction->flag = 'profit';
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
        if (env('PREVIOUS_DATA_ENTRY','no')=='yes'){

            $transaction->canculatable = $request->canculatable;
        }
        $transaction->save();

        if ($request->invoice)
        {
            return redirect('transaction-invoice/'.$transaction->txn_id);
        }

        return back()->withSuccess('সফলভাবে সেভ করা হয়েছে');
    }

    public function CollectionList(Request $request,$type)
    {
        $saving_ids = Saving::where('type',$type)->get('id');
        $transactions = Transaction::with('user','receiver','savings')->where('transaction_for','saving')
        ->where('flag','deposit')
        ->whereIn('transactable_id',$saving_ids)
        ->where(function ($q) use ($request,$saving_ids){
            if ($request->has('from') && $request->from) {
                $from = date("Y-m-d", strtotime($request->from));
                $q->where(DB::raw('DATE(date)'),'>=',$from);

            }
            if ($request->has('to') && $request->to) {

                $to = date("Y-m-d", strtotime($request->to));
                $q->where(DB::raw('DATE(date)'),'<=',$to);

            }

        })
        ->orderBy('date','DESC');
        if(isset($request->limit) && $request->limit=='-1'){
            $transactions = $transactions->paginate($transactions->count());
        }else{
            $transactions = $transactions->paginate(25);
        }

        $total = Transaction::where('transaction_for','saving')
        ->where('flag','deposit')
        ->whereIn('transactable_id',$saving_ids)
        ->where(function ($q) use ($request,$saving_ids){
            if ($request->has('from') && $request->from) {
                $from = date("Y-m-d", strtotime($request->from));
                $q->where(DB::raw('DATE(date)'),'>=',$from);

            }
            if ($request->has('to') && $request->to) {

                $to = date("Y-m-d", strtotime($request->to));
                $q->where(DB::raw('DATE(date)'),'<=',$to);

            }

        })
        ->sum('amount');
        return view('admin/saving/collection-list',compact('transactions','total'));
    }

    public function WithdrawList(Request $request,$type)
    {
        $saving_ids = Saving::where('type',$type)->get('id')->pluck('id');
        $transactions = Transaction::with('user','receiver','savings')->where('transaction_for','saving')
        ->whereIn('flag',['profit_withdraw','deposit_withdraw'])

        ->where('type','expense')
        ->whereIn('transactable_id',$saving_ids)
        ->where(function ($q) use ($request,$saving_ids){
            if ($request->has('from') && $request->from) {
                $from = date("Y-m-d", strtotime($request->from));
                $q->where(DB::raw('DATE(date)'),'>=',$from);

            }
            if ($request->has('to') && $request->to) {

                $to = date("Y-m-d", strtotime($request->to));
                $q->where(DB::raw('DATE(date)'),'<=',$to);

            }

        })
        ->orderBy('date','DESC');
        if(isset($request->limit) && $request->limit=='-1'){
            $transactions = $transactions->paginate($transactions->count());
        }else{
            $transactions = $transactions->paginate(25);
        }

        //return $transactions;


        $total = Transaction::where('transaction_for','saving')
        ->where('type','expense')
        ->whereIn('transactable_id',$saving_ids)
        ->where(function ($q) use ($request,$saving_ids){
            if ($request->has('from') && $request->from) {
                $from = date("Y-m-d", strtotime($request->from));
                $q->where(DB::raw('DATE(date)'),'>=',$from);

            }
            if ($request->has('to') && $request->to) {

                $to = date("Y-m-d", strtotime($request->to));
                $q->where(DB::raw('DATE(date)'),'<=',$to);

            }

        })
        ->sum('amount');


        return view('admin/saving/withdraw-list',compact('transactions','total'));
    }

    public function SavingApplication(Request $request)
    {

        $this->validate($request,
            [
                'user_id' => 'required',
                'package_id' => 'required',
            ]
        );

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

            if($request->unique_id){

                $this->validate($request,
                    [
                        'unique_id' => 'required|unique:users',
                    ]
                );

            }
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

            if ($request->hasFile('document')) {

                $image      = $request->file('document');
                $imageName  = 'document_'.date('ymdhis').'.'.$image->getClientOriginalExtension();
                $path       = 'images/member/';
                $image->move($path, $imageName);
                $imageUrl   = $path . $imageName;
                $member->document = $imageUrl ;
            }
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

        $package = SavingPackage::find($request->package_id);


        $started_at = date('Y-m-d H:i:s',strtotime($request->date));
        $end_at = date('Y-m-d H:i:s', strtotime($started_at . "+ ".($request->type=='long'?120:60)." months"));


        //Create Saving Application

        $saving = new Saving();
        $saving->txn_id = uniqid();
        $saving->user_id = $member->id;
        $saving->identifier_id = $request->identifier_id??0;
        $saving->package_id = $request->package_id;
        $saving->type = $request->type;
        $saving->target_amount = $package->target_amount;
        $saving->installment_amount = $package->installment_amount;
        $saving->installment_qty = $package->installment_qty;
        $saving->return_amount = $package->return_amount;
        $saving->interest_rate = $package->interest_rate;
        $saving->duration = $request->type=='long'?120:60;
        $saving->started_at = $started_at;
        $saving->end_at = $end_at;
        $saving->added_by = Auth::user()->id;
        $saving->note = '';
        $saving->admin_status = 'pending';
        $saving->manager_status = 'pending';
        $saving->status = 'pending';
        $saving->save();


        return back()->withSuccess('সফলভাবে অ্যাপ্লিকেশনটি সেভ করা হয়েছে');
    }


    public function SavingDailyApplication(Request $request)
    {

        $this->validate($request,
            [
                'user_id' => 'required',
                //'identifier_id' => 'required',
                'installment_amount' => 'required',
            ]
        );

        if ($request->user_id=='no'){


            if($request->unique_id){

                $this->validate($request,
                    [
                        'unique_id' => 'required|unique:users',
                    ]
                );

            }
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
            if ($request->has('unique_id')){ $member->unique_id = $request->unique_id;}else{$member->unique_id = $random_account;}
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

        $started_at = date('Y-m-d H:i:s',strtotime($request->date));
        $end_at = date('Y-m-d H:i:s', strtotime($started_at . "+ ".$request->duration." months"));


        //Create Saving Application

        $saving = new Saving();
        $saving->txn_id = uniqid();
        $saving->user_id = $member->id;
        $saving->identifier_id = $request->identifier_id??0;
        //$saving->package_id = $request->package_id;
        $saving->type = $request->type;
        //$saving->target_amount = $package->target_amount;
        $saving->installment_amount = $request->installment_amount;
        //$saving->installment_qty = $package->installment_qty;
        //$saving->return_amount = $package->return_amount;
        //$saving->interest_rate = $package->interest_rate;
        $saving->duration = $request->duration;
        $saving->started_at = $started_at;
        $saving->end_at = $end_at;
        $saving->added_by = Auth::user()->id;
        $saving->note = '';
        $saving->admin_status = 'pending';
        $saving->manager_status = 'pending';
        $saving->status = 'pending';
        $saving->save();


        return back()->withSuccess('সফলভাবে অ্যাপ্লিকেশনটি সেভ করা হয়েছে');
    }



    public function SavingCurrentApplication(Request $request)
    {

        $this->validate($request,
            [
                'user_id' => 'required',
            ]
        );

        if ($request->user_id=='no'){
            $random_account = uniqid();
            $random_email = uniqid().'temporaryemail@ontorongo.com';
            $random_password = bcrypt('12345678');

            if($request->unique_id){

                $this->validate($request,
                    [
                        'unique_id' => 'required|unique:users',
                    ]
                );

            }
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
            if ($request->has('unique_id')){ $member->unique_id = $request->unique_id;}else{$member->unique_id = $random_account;}
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

        $started_at = date('Y-m-d H:i:s',strtotime($request->date));
        //$end_at = date('Y-m-d H:i:s', strtotime($started_at . "+ ".$request->duration." months"));


        //Create Saving Application

        $saving = new Saving();
        $saving->txn_id = uniqid();
        $saving->user_id = $member->id;
        $saving->identifier_id = $request->identifier_id??0;
        $saving->type = $request->type;
        $saving->installment_amount = $request->installment_amount??0;
        $saving->duration = $request->duration??0;
        $saving->started_at = $started_at;
        //$saving->end_at = $end_at;
        $saving->added_by = Auth::user()->id;
        $saving->note = '';
        $saving->admin_status = 'pending';
        $saving->manager_status = 'pending';
        $saving->status = 'pending';
        $saving->save();


        return back()->withSuccess('সফলভাবে অ্যাপ্লিকেশনটি সেভ করা হয়েছে');
    }

    public function getList(Request $request, $type)
    {


        $records = Saving::with('user')->where(function ($q) use ($request,$type){
            $q->where('type', $type);

            if ($request->has('from') && $request->from) {
                $from = date("Y-m-d", strtotime($request->from));
                $q->where('started_at', '>=',  $from);

            }
            if ($request->has('to') && $request->to) {

                $to = date("Y-m-d", strtotime($request->to));
                $q->where('started_at', '<=',  $to);

            }
            if ($request->has('filterBy') && $request->filterBy !='all') {
                $q->where('status', $request->filterBy);

            }


        })->orderBy('created_at','DESC');

        if ($request->has('status') && $request->status) {

            if($request->status=='approved'){
                $records = $records->where('status',$request->status);
            }elseif($request->status=='closed'){
                $records = $records->where('status',$request->status);
            }
        }

        if(isset($request->limit) && $request->limit=='-1'){
            $limit_book = $records->get('id');
            $limit_book_amount = $records->sum('target_amount');
            $records = $records->paginate($records->count());
        }else{
            $records = $records;
        if(isset($request->limit) && $request->limit=='-1'){
            $limit_book = $records->get('id');
            $limit_book_amount = $records->sum('target_amount');
            $records = $records->paginate($records->count());
        }else{
            $limit_book = $records->get('id');
            $limit_book_amount = $records->sum('target_amount');
            $records = $records->paginate(25);
        }

        }

        $active_count   = Saving::where('type',$type)->where('status','approved')->count();
        $pending_count   = Saving::where('type',$type)->where('status','pending')->count();
        $declined_count   = Saving::where('type',$type)->where('status','declined')->count();
        $closed_count   = Saving::where('type',$type)->where('status','closed')->count();

        $closed_ids = Saving::where('type',$type)->where('status','closed')->get(['id'])->pluck('id');

        $closed_target_amount   = Saving::where('type',$type)->where('status','closed')->sum('target_amount');


        $closed_total_profit_paid = Transaction::where('transaction_for','saving')->whereIn('transactable_id',$closed_ids)->where('flag','profit_withdraw')->sum('amount');
        $closed_total_revenue_paid = Transaction::where('transaction_for','saving')->whereIn('transactable_id',$closed_ids)->where('flag','deposit_withdraw')->sum('amount');

        // $closed_saving_return_amount   = Saving::where('type',$type)->where('status','closed')->sum('return_amount');
        // $closed_saving_profit   = $closed_target_amount + $closed_saving_return_amount ;

        return view('admin/saving/list',compact('records','type','active_count','pending_count','declined_count',
        'closed_count','closed_target_amount','closed_total_profit_paid','closed_total_revenue_paid','limit_book',
    'limit_book_amount'));
    }

    public function getSavingsByUser(Request $request)
    {


        $records = Saving::with('user','package')->where('user_id',$request->user_id)->get();
        return $records;
    }
    public function getSavingDetails(Request $request)
    {


        $records = Saving::with('user')->where('id',$request->saving_id)->first();
        return $records;
    }

    public function AdminApprove($id)
    {
        $saving = Saving::find($id);
        $saving->admin_status = 'approved';
        $saving->manager_status = 'approved';
        $saving->status = 'approved';
        $saving->approved_at=date("Y-m-d H:i:s");
        $saving->save();

        return back()->withSuccess('সফলভাবে আনুমদন করা হয়েছে');
    }

    public function AdminDecline($id)
    {
        $saving = Saving::find($id);
        $saving->admin_status = 'declined';
        $saving->manager_status = 'declined';
        $saving->status = 'declined';

        $saving->declined_at=date("Y-m-d H:i:s");
        $saving->save();

        return back()->withSuccess('সফলভাবে প্রত্যাখ্যান করা হয়েছে');
    }

    public function DeleteSaving($id)
    {
        $saving = Saving::destroy($id);

        Transaction::where('transaction_for','saving')->where('transactable_id',$id)->delete();
        return redirect('admin/dashboard')->withSuccess('সফলভাবে মুছে ফেলা হয়েছে');
    }

    public function  SavingEdit($id)
    {
        $saving = Saving::with('user','package')->where('id',$id)->first();

        $packages = SavingPackage::where('type',$saving->type)->get();

        $members = User::where('role','member')->orderBy('name','ASC')->get();

        return view('admin/saving/edit',compact('saving','members','packages'));
    }

    public function SavingUpdate(Request $request,$id)
    {

        $this->validate($request,[
            'package_id'=>'required',
        ]);
       $saving = Saving::find($id);
        $saving->user_id = $request->user_id;
        $saving->identifier_id = $request->identifier_id??0;
        if ($request->type=='daily') {

            $saving->installment_amount = $request->installment_amount;
        $saving->duration = $request->duration;
        }else{

            $package = SavingPackage::find($request->package_id);

            $saving->package_id = $request->package_id;
            $saving->target_amount = $package->target_amount;
            $saving->installment_qty = $package->installment_qty;
            $saving->return_amount = $package->return_amount;
            $saving->interest_rate = $package->interest_rate;
        }
        $saving->type = $request->type;
        $saving->added_by = Auth::user()->id;
        $saving->note = $request->note??'';
        $saving->status = $request->stat;
        $saving->started_at = $request->date;
        $saving->save();



        return back()->withSuccess('সফলভাবে অ্যাপ্লিকেশনটি সেভ করা হয়েছে');
    }


    public function SavingClose($id){
        $saving = Saving::find($id);
        if(!$saving){
            return back()->withError('Not found');
        }

        $saving->status='closed';
        $saving->closed_at=date("Y-m-d H:i:s");
        $saving->save();

        return back()->withSuccess('সফলভাবে সদস্য পদ প্রত্যাহার করা হয়েছে!');

    }


    public function fine_income(Request $request)
    {

        $this->validate($request,[
            'saving_id'=>'required',
            'user_id'=>'required',
            'amount'=>'required',
            'date'=>'required',
        ]);



        $saving = Saving::find($request->saving_id);

        if(!$saving){
            return back()->withError('Related saving didn\'t found!');
        }

        $head = TransactionHead::where('slug','fine_income')->first();

        if(!$head){
            return back()->withError('Related head didn\'t found!');
        }
        $transaction = new Transaction();
        $transaction->txn_id = uniqid();
        $transaction->transaction_for = 'saving';
        $transaction->transactable_id = $request->saving_id;
        $transaction->flag = 'fine';
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
        if (env('PREVIOUS_DATA_ENTRY','no')=='yes'){

            $transaction->canculatable = $request->canculatable;
        }

        $transaction->save();

        if ($request->invoice)
        {
            return redirect('transaction-invoice/'.$transaction->txn_id);
        }
        return back()->withSuccess('সফলভাবে সেভ করা হয়েছে');
    }



}
