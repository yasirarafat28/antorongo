<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Fdr;
use App\FdrTransaction;
use Illuminate\Support\Facades\Auth;
use App\NumberConverter;
use App\Transaction;
use App\TransactionHead;

class FdrController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:fdr-application', ['only' => ['application','ApplicationSubmit']]);
        $this->middleware('permission:fdr-approve', ['only' => ['AdminApprove']]);
        $this->middleware('permission:fdr-close', ['only' => ['close']]);
        $this->middleware('permission:fdr-decline', ['only' => ['AdminDecline']]);
        $this->middleware('permission:saving-short-edit', ['only' => ['FdrEdit','FdrUpdate']]);
        $this->middleware('permission:fdr-list', ['only' => ['FdrList']]);
        $this->middleware('permission:fdr-find', ['only' => ['find']]);
        $this->middleware('permission:fdr-profit-report-list', ['only' => ['profitReport']]);
        $this->middleware('permission:fdr-withdraw-report-list', ['only' => ['withdrawReport']]);



    }


    public  function Application()
    {
        $members = User::where('role','member')->orderBy('name','ASC')->get();

        return view('admin/fdr/application',compact('members'));
    }



    public function ApplicationSubmit(Request $request)
    {

        $this->validate($request,
            [
                'user_id' => 'required',
                'amount' => 'required',
                'interest_rate' => 'required',
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

        $started_at = date('Y-m-d H:i:s',strtotime($request->date));
        $end_at = date('Y-m-d H:i:s', strtotime($started_at . "+".$request->duration." months"));



        $fdr = new Fdr();
        $fdr->txn_id = $request->fdr_unique_id??uniqid();
        $fdr->user_id = $member->id;
        $fdr->profit_type = $request->profit_type;
        $fdr->duration = NumberConverter::bn2en($request->duration);
        $fdr->started_at = $started_at;
        $fdr->end_at = $end_at;
        $fdr->added_by = Auth::user()->id;
        $fdr->note = $request->note;
        $fdr->interest_rate = NumberConverter::bn2en($request->interest_rate);
        $fdr->admin_status = 'approved';
        $fdr->manager_status = 'approved';
        $fdr->status = 'pending';
        $fdr->save();


        // $transaction = new FdrTransaction();
        // $transaction->txn_id = uniqid();
        // $transaction->type = 'deposit';
        // $transaction->user_id = $member->id;
        // $transaction->fdr_id = $fdr->id;
        // $transaction->amount = NumberConverter::bn2en($request->amount);
        // $transaction->started_at = $started_at;
        // $transaction->end_at = $end_at;
        // $transaction->added_by = Auth::user()->id;
        // $transaction->note = $request->note;
        // $transaction->admin_status = 'approved';
        // $transaction->manager_status = 'approved';
        // $transaction->status = 'approved';
        // $transaction->save();
        return back()->withSuccess('সফলভাবে অ্যাপ্লিকেশনটি সেভ করা হয়েছে');
    }



    public function FdrList(Request $request)
    {


        $records = Fdr::with('user','histories')->where(function ($q) use ($request){
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

        });
        if(isset($request->limit) && $request->limit=='-1'){
            $records = $records->orderBy('created_at','DESC')->paginate($records->count());
        }else{
            $records = $records->orderBy('created_at','DESC')->paginate(25);
        }



        $active_count   = Fdr::where('status','approved')->count();
        $pending_count   = Fdr::where('status','pending')->count();
        $declined_count   = Fdr::where('status','declined')->count();
        $closed_count   = Fdr::where('status','closed')->count();

        return view('admin/fdr/list',compact('records','active_count','pending_count','declined_count','closed_count'));
    }

    public function AdminApprove($id)
    {
        $fdr = Fdr::find($id);
        $fdr->admin_status = 'approved';
        $fdr->manager_status = 'approved';
        $fdr->status = 'approved';
        $fdr->save();



        $head = TransactionHead::where('slug','fdr_revenue_income')->first();

        if(!$head){
            return back()->withError('Related head didn\'t found!');
        }

        $deposit = Transaction::where('transaction_for','fdr')
        ->where('transactable_id',$fdr->id)
        ->where('flag','deposit')->first();

        if(!$deposit){
            $deposit = new Transaction();
        }
        $deposit->txn_id = uniqid();
        $deposit->transaction_for = 'fdr';
        $deposit->transactable_id = $fdr->id;
        $deposit->flag = 'deposit';
        $deposit->type = 'income';
        $deposit->head_id = $head->id;
        $deposit->user_id = $fdr->user_id;
        $deposit->note = $fdr->note;
        $deposit->date = $fdr->started_at;
        $deposit->amount = NumberConverter::bn2en($fdr->amount);
        $deposit->added_by = Auth::user()->id;
        $deposit->received_by = Auth::user()->id;
        $deposit->admin_status ='approved';
        $deposit->manager_status = 'approved';
        $deposit->status = 'approved';
        $deposit->save();


        return back()->withSuccess('সফলভাবে আনুমদন করা হয়েছে');
    }

    public function AdminDecline($id)
    {
        $fdr = Fdr::find($id);
        $fdr->admin_status = 'declined';
        $fdr->manager_status = 'declined';
        $fdr->status = 'declined';
        $fdr->save();

        return back()->withSuccess('সফলভাবে প্রত্যাখ্যান করা হয়েছে');
    }


    public  function find(Request $request)
    {

        if ($request->has('id')) {


            $fdr = Fdr::with('user','histories','receiver')->where('id',$request->id)->first();
            $query = $fdr->txn_id;
        }elseif ($request->has('q')) {

            $query = $request->q;

            $fdr = Fdr::with('user','histories','receiver')->where('txn_id',$request->q)->first();
        }
        else{
            $fdr ='';
            $query = '';
        }


        if($fdr){

            $histories = FdrTransaction::with('user','receiver')->where('fdr_id',$fdr->id)->orderBy('id','DESC')->get();
        }else{
            $histories = '';
        }
        return view('admin/fdr/find',compact('fdr','query','histories'));
    }

    public function withdraw(Request $request)
    {
        $this->validate($request,[
            'fdr_id'=>'required',
            'user_id'=>'required',
            'amount'=>'required',
            'date'=>'required',
        ]);

        $fdr = Fdr::find($request->fdr_id);
        if(!$fdr){
            return back()->withError('Related FDR didn\'t found!');
        }

        if( ($request->withdraw_source=='profit'    &&  $fdr->profit_balance() < $request->amount) || ($request->withdraw_source=='revenue' &&  $fdr->balance() < $request->amount)){
            return back()->withErrors('দুঃখিত ! উত্তোলন করার জন্য যথেষ্ট পরিমান ব্যালেন্স নেই!');
        }

        if($request->withdraw_source=='profit'){
            $head = TransactionHead::where('slug','fdr_refund_expense')->first();
        }else{
            $head = TransactionHead::where('slug','fdr_profit_expense')->first();

        }


        if(!$head){
            return back()->withErrors('Related head didn\'t found!');
        }
        $transaction = new Transaction();
        $transaction->txn_id = uniqid();
        $transaction->transaction_for = 'fdr';
        $transaction->transactable_id = $request->fdr_id;
        $transaction->flag = 'withdraw';
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
        $transaction->save();

        if ($request->invoice)
        {
            return redirect('transaction-invoice/'.$transaction->txn_id);
        }
        return back()->withSuccess('সফলভাবে সেভ করা হয়েছে');

    }

    public function  withdrawReport(Request $request)
    {

        $transactions = Transaction::with('user','receiver','fdr')->where('transaction_for','fdr')->where(function ($q) use ($request){
            $q->where('flag','withdraw');
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


        $total = Transaction::where('transaction_for','fdr')
        ->where('flag','withdraw')
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
        return view('admin/fdr/withdraw-list',compact('transactions','total'));
    }


    public function  profitReport(Request $request)
    {

        $transactions = Transaction::with('user','receiver','fdr')->where(function ($q) use ($request){
            $q->where('transaction_for','fdr');
            $q->where('flag','profit');
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


        $total = Transaction::where('transaction_for','fdr')
        ->where('flag','profit')
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
        return view('admin/fdr/profit-list',compact('transactions','total'));
    }

    public function ManualProfit(Request $request)
    {


        $this->validate($request,[
            'fdr_id'=>'required',
            'amount'=>'required',
            'amount'=>'required',
        ]);

        $transaction = new Transaction();
        $transaction->txn_id = uniqid();
        $transaction->transaction_for = 'fdr';
        $transaction->transactable_id = $request->fdr_id;
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
        $transaction->canculatable='no';
        $transaction->save();

        return back()->withSuccess('সফলভাবে সেভ করা হয়েছে');
    }



    public function getFdrsByUser(Request $request)
    {


        $records = Fdr::with('user')->where('user_id',$request->user_id)->get();
        return $records;
    }
    public function getFdrDetails(Request $request)
    {


        $records = Fdr::with('user')->where('id',$request->fdr_id)->first();
        return $records;
    }



    public function  FdrEdit($id)
    {
        $fdr = Fdr::with('user')->where('id',$id)->first();
        $members = User::where('role','member')->orderBy('name','ASC')->get();

        return view('admin/fdr/edit',compact('fdr','members'));
    }

    public function FdrUpdate(Request $request,$id)
    {



        $started_at = date('Y-m-d H:i:s',strtotime($request->date));
        $end_at = date('Y-m-d H:i:s', strtotime($started_at . "+".$request->duration." months"));

        $fdr = Fdr::find($id);
        $fdr->txn_id = $request->fdr_unique_id;
        $fdr->user_id = $request->user_id;
        $fdr->profit_type = $request->profit_type;
        $fdr->note = $request->note;
        $fdr->status = $request->stat;
        $fdr->duration = NumberConverter::bn2en($request->duration);
        $fdr->started_at = $started_at;
        $fdr->end_at = $end_at;
        $fdr->added_by = Auth::user()->id;
        $fdr->interest_rate = NumberConverter::bn2en($request->interest_rate);
        $fdr->save();


        $transaction =FdrTransaction::where('type','deposit')->where('fdr_id',$fdr->id)->first();
        $transaction->added_by = Auth::user()->id;
        $transaction->amount = NumberConverter::bn2en($request->amount);
        $transaction->note = $request->note;
        $transaction->save();


        return back()->withSuccess('সফলভাবে  সেভ করা হয়েছে');
    }

    public function close($id){


        $fdr = Fdr::find($id);
        if(!$fdr){
            return back()->withError('Not found');
        }

        $fdr->status='closed';
        $fdr->save();

        return back()->withSuccess('সফলভাবে সদস্য পদ প্রত্যাহার করা হয়েছে!');
    }

    public function Deletefdr($id)
    {
        $fdr = Fdr::destroy($id);

        Transaction::where('transaction_for','fdr')->where('transactable_id',$id)->delete();
        return redirect('admin/fdr/list')->withSuccess('সফলভাবে মুছে ফেলা হয়েছে');
    }

}
