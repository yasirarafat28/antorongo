<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Inquery;
use Auth;

class InqueryController extends Controller
{
    //

    public function index(Request $request)
    {

    	$inqueries = Inquery::with('user')
            ->where(function ($q) use ($request){
                if ($request->has('search')) {
                    $q->where('subject', 'like', '%' . $request->search . '%');
                    $q->orWhere('message', 'like', '%' . $request->search . '%');

                }

                if ($request->has('type')) {
                    if ($request->type=='unread')
                    {
                        $q->where('status','pending');
                    }elseif ($request->type=='read')
                    {
                        $q->where('status','reviewed');
                    }

                }

            })

            ->where(function ($q) use ($request){
                if (Auth::user()->roles()->first()->name=='member'){
                    $q->where('to_user_id',Auth::user()->id);
                }else{
                    $q->where('to_user_id',Auth::user()->id);
                    $q->orWhere('type','inquery');
                }

            })
            ->orderBy('id','DESC')->paginate(25);
    	return view('admin/inbox',compact('inqueries'));
    }

    public function single($id)
    {
        $item = Inquery::with('user','receiver')->where('id',$id)->first();
        return view('admin/inbox-single',compact('item'));
    }

    public function MemberInqueryForm()
    {
        return view('member/inquery-submit');
    }

    public function compose()
    {
        return view('admin/compose');
    }

    public function SubmitCompose(Request $request)
    {
        //return $request;
        $receiver = User::where('email',$request->to_user_id)->first();
        if (!$receiver)
        {
            return back()->withErrors('Found no User by the email!');
        }

        $inquery = new Inquery();
        $inquery->name = Auth::user()->name;
        $inquery->email = Auth::user()->email;
        $inquery->user_id = Auth::user()->id;
        $inquery->to_user_id = $receiver->id ?? 0;
        $inquery->subject = $request->subject;
        $inquery->message = $request->message;
        $inquery->type = 'mail';
        $inquery->save();

        return back()->withSuccess('Message Sent!');
    }


    public function submit(Request $request)
    {
    	$name = $request->name;

    	$inquery = new Inquery();
    	$inquery->name = Auth::user()->name;
    	$inquery->email = Auth::user()->email;
    	$inquery->user_id = Auth::user()->id;
    	$inquery->subject = $request->subject;
    	$inquery->message = $request->message;
    	$inquery->save();

    	return back()->withSuccess('Thanks for submitting Inquery!');

    }
}
