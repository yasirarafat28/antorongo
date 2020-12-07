<?php

namespace App\Http\Controllers;

use App\SalaryPayment;
use Illuminate\Http\Request;
use App\User;

class SalaryPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

        $members = User::where('role','admin')->orderBy('name','ASC')->get();
        $records = SalaryPayment::with('user')->orderBy('id','DESC');
        if(isset($request->limit) && $request->limit=='-1'){
            $records = $records->paginate($records->count());
        }else{
            $records = $records->paginate(25);
        }

        return view('admin/hr/salary-payment',compact('records','members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {



        $structure = new SalaryPayment();
        $structure->user_id = $request->user_id;
        $structure->basic_allowance = $request->basic_allowance;
        $structure->dearness_allowance = $request->dearness_allowance;
        $structure->medical_allowance = $request->medical_allowance;
        $structure->house_rent_allowance = $request->house_rent_allowance;
        $structure->bonus_allowance = $request->bonus_allowance;
        $structure->other_addition_allowance = $request->other_addition_allowance;
        $structure->p_fund_deduction = $request->p_fund_deduction;
        $structure->pro_tax_deduction = $request->pro_tax_deduction;
        $structure->loan_deduction = $request->loan_deduction??0;
        $structure->other_deduction = $request->other_deduction;
        $structure->fine = $request->fine;
        $structure->payment_month = $request->month;
        $structure->payable_amount = $request->payable;
        $structure->paid_amount = $request->paid;
        $structure->remark = $request->note;
        $structure->status = 'active';
        $structure->save();

        return back()->withSuccess('সফলভাবে সেভ করা হয়েছে');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SalaryPayment  $salaryPayment
     * @return \Illuminate\Http\Response
     */
    public function show(SalaryPayment $salaryPayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SalaryPayment  $salaryPayment
     * @return \Illuminate\Http\Response
     */
    public function edit(SalaryPayment $salaryPayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SalaryPayment  $salaryPayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SalaryPayment $salaryPayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SalaryPayment  $salaryPayment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        SalaryPayment::destroy($id);

        return back()->withSuccess('সফলভাবে ডিলিট  করা হয়েছে');
    }
}
