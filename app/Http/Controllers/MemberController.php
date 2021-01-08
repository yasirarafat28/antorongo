<?php

namespace App\Http\Controllers;

use App\District;
use App\Thana;
use App\Loan;
use App\Saving;
use App\Fdr;
use App\MemberRelation;
use App\Transaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Yajra\DataTables\Facades\DataTables;

class MemberController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:member-find', ['only' => ['MemberFind']]);
        $this->middleware('permission:member-list', ['only' => ['index']]);
        $this->middleware('permission:member-create', ['only' => ['create','store']]);
        $this->middleware('permission:member-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:member-show', ['only' => ['show']]);
        $this->middleware('permission:member-delete', ['only' => ['destroy']]);

    }


    public function MemberFind(Request $request)
    {

        if ($request->has('q')) {

            $query = $request->q;
            $member = User::where('unique_id',$request->q)->orWhere('email',$request->q)->orWhere('phone',$request->q)->first();
            // L,FD,G,C,FM,

            $releted_query = array();

            // if (strpos($query, 'L') !== false) {
            //     $releted_query[0] = str_replace('L', 'FD', $query);
            //     $releted_query[1] = str_replace('L', 'G', $query);
            //     $releted_query[2] = str_replace('L', 'C', $query);
            //     $releted_query[3] = str_replace('L', 'FM', $query);
            // }elseif (strpos($query, 'FD') !== false) {
            //     $releted_query[0] = str_replace('FD', 'L', $query);
            //     $releted_query[1] = str_replace('FD', 'G', $query);
            //     $releted_query[2] = str_replace('FD', 'C', $query);
            //     $releted_query[3] = str_replace('FD', 'FM', $query);
            // }elseif (strpos($query, 'G') !== false) {
            //     $releted_query[0] = str_replace('G', 'L', $query);
            //     $releted_query[1] = str_replace('G', 'FD', $query);
            //     $releted_query[2] = str_replace('G', 'C', $query);
            //     $releted_query[3] = str_replace('G', 'FM', $query);
            // }elseif (strpos($query, 'C') !== false) {
            //     $releted_query[0] = str_replace('C', 'L', $query);
            //     $releted_query[1] = str_replace('C', 'FD', $query);
            //     $releted_query[2] = str_replace('C', 'G', $query);
            //     $releted_query[3] = str_replace('C', 'FM', $query);
            // }elseif (strpos($query, 'FM') !== false) {
            //     $releted_query[0] = str_replace('FM', 'L', $query);
            //     $releted_query[1] = str_replace('FM', 'FD', $query);
            //     $releted_query[2] = str_replace('FM', 'G', $query);
            //     $releted_query[3] = str_replace('FM', 'C', $query);
            // }

            // if (sizeof($releted_query)<1) {
            //     $releted_user_ids = array();
            // }else{

            //     $releted_user_ids = User::where('unique_id','like','%'.$releted_query[0].'%')->orWhere('unique_id','like','%'.$releted_query[1].'%')->orWhere('unique_id','like','%'.$releted_query[2].'%')->orWhere('unique_id','like','%'.$releted_query[3].'%')->orWhere('unique_id','like','%'.$query.'%')
            //     ->get('id')->pluck('id')->toArray();
            // }

            $releted_user_ids = MemberRelation::releted_user_ids($member->id);


            if($member)
                array_push($releted_user_ids,$member->id);



            //return $releted_user_ids;



            $loan_records = Loan::with('user')->whereIn('user_id',$releted_user_ids)->get();

            $saving_records = Saving::with('user')->whereIn('user_id',$releted_user_ids)->get();
            $FDR_records = Fdr::with('user')->whereIn('user_id',$releted_user_ids)->get();
        }elseif ($request->has('id')) {

            $query = $request->id;
            $member = User::where('id',$request->id)->first();

            $releted_user_ids = array();


            if($member){

                $releted_user_ids = MemberRelation::releted_user_ids($member->id);
                array_push($releted_user_ids,$member->id);
            }

            $loan_records = Loan::with('user')->whereIn('user_id',$releted_user_ids)->get();

            $saving_records = Saving::with('user')->whereIn('user_id',$releted_user_ids)->get();
            $FDR_records = Fdr::with('user')->whereIn('user_id',$releted_user_ids)->get();
        }
        else{
            $member ='';
            $saving_records ='';
            $loan_records ='';
            $FDR_records ='';
            $query = '';
        }
        return view('admin/member/find',compact('query','member','loan_records','saving_records','FDR_records'));
    }

    public function getData(Request $request){
        //return $request;

        return DataTables::of(User::query()->where(function($q) use($request){
            if(isset($request->project) && $request->project){
                $q->where('project',$request->project);

            }

        }))
        ->addColumn('action', function ($item) {
            return view( 'admin.member.action', compact('item'));
        })
        ->make(true);
    }


    public function index(Request $request)
    {


        return view('admin/member/list');

        /*$members = User::withCount('totalLoan','totalFdr','totalSaving')->where('role','member')->where(function ($q) use ($request){

            if ($request->has('from') && $request->from) {
                $from = date("Y-m-d", strtotime($request->from));
                $q->where('created_at', '>=',  $from);

            }
            if ($request->has('to') && $request->to) {

                $to = date("Y-m-d", strtotime($request->to));
                $q->where('created_at', '<=',  $to);

            }
            if ($request->has('district') && $request->district) {
                $q->where('district', $request->district);

            }
            if ($request->has('thana') && $request->thana) {
                $q->where('thana', '<=',  $request->thana);

            }

        })->orderBy('created_at','DESC')->paginate(50);


        $districts=  District::orderBy('name','ASC')->get();
        if ($request->has('district'))
        {
            $thanas=  Thana::where('district_id',$request->district)->orderBy('name','ASC')->get();
        }else{
            $thanas=  Thana::orderBy('name','ASC')->get();
        }

        return view('admin/member/list',compact('members','districts','thanas','request'));*/
    }

    public function create()
    {
        return view('admin/member/create');
    }

    public function store(Request $request)
    {
        //return $request;
        $this->validate($request,
            [
                'name' => 'required',
                'name_bn' => 'required',
                'phone' => 'required',
                'nid' => 'required',
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

        return back()->withSuccess('সদস্য সফলভাবে যোগ করা হয়েছে!');


    }

    public function edit($id)
    {
        $member = User::find($id);

        return view('admin/member/edit',compact('member'));

    }


    public function update(Request $request,$id)
    {
        //return $request;
        $this->validate($request,
            [
                'name' => 'required',
                'name_bn' => 'required',
                'phone' => 'required',
                'nid' => 'required',
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

        $member = User::find($id);
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

        if ($request->has('email'))
        {
            $member->email = $request->email;
        }
        if ($request->has('unique_id')){
            $this->validate($request,[
                'unique_id'=>'unique:users,unique_id,'.$member->id
            ]);
            $member->unique_id = $request->unique_id;
        }
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

        return back()->withSuccess('সদস্য সফলভাবে আপডেট করা হয়েছে!');


    }


    public function destroy($id)
    {
        //
        User::destroy($id);
        Transaction::where('user_id',$id)->delete();
        Saving::whare('user_id',$id)->delete();
        Fdr::whare('user_id',$id)->delete();
        Loan::whare('user_id',$id)->delete();
        return redirect('/admin/members')->withSuccess('সফলভাবে সেভ করা হয়েছে');
    }


    public function generateRandomString($length = 11)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;

    }

    public function assign_share_holder(Request $request){
        $this->validate($request,[
            'user_id'=>'required',
            'parent_id'=>'required',

        ]);

        $member = User::where('id',$request->user_id)->update([
            'parent_id'=>$request->parent_id,
        ]);

        return back()->withSuccess('Share holder successfully assigned');
    }


    public function add_to_group(Request $request){

        $this->validate($request,[
            'parent_id'=>'required',
            'user_id'=>'required',
        ]);

        $row=  new MemberRelation();
        $row->user_id = $request->parent_id;
        $row->releted_user_id = $request->user_id;
        $row->save();


        return back()->withSuccess('সফলভাবে সেভ করা হয়েছে!');

    }

    public function remove_from_group($id){
        //return $id;
        MemberRelation::where('releted_user_id',$id)->delete();
        return back()->withSuccess('সফলভাবে মুছে ফেলা হয়েছে!');
    }


}
