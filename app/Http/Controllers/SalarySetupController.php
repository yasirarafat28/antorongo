<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\SalarySetup;

class SalarySetupController extends Controller
{
     // function __construct()
    // {
    //     $this->middleware('permission:hr-salary-setup-list', ['only' => ['index']]);
    //     $this->middleware('permission:hr-salary-setup-create', ['only' => ['create','store']]);
    //     $this->middleware('permission:hr-salary-setup-edit', ['only' => ['edit','update']]);
    //     $this->middleware('permission:hr-salary-setup-show', ['only' => ['show']]);
    //     $this->middleware('permission:hr-salary-setup-delete', ['only' => ['destroy']]);
    // }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $members = User::where('role','admin')->orderBy('name','ASC')->get();
        $records = SalarySetup::with('user')->orderBy('id','DESC')->get();

        return view('admin/hr/salary-setup',compact('records','members'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[

            'user_id'=>'required',
            'basic_allowance'=>'required',

        ]);

        // return $request;

        $structure = new SalarySetup();
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
        $structure->status = 'active';
        $structure->save();

        return back()->withSuccess('সফলভাবে সেভ করা হয়েছে');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[

            'user_id'=>'required',
            'basic_allowance'=>'required',

        ]);


        $structure = SalarySetup::find($id);
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
        $structure->status = 'active';
        $structure->save();

        return back()->withSuccess('সফলভাবে আধুনিক করা হয়েছে');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        SalarySetup::destroy($id);

        return back()->withSuccess('সফলভাবে ডিলিট  করা হয়েছে');

    }

    public function getSalaryStructure(Request $request)
    {
        $structure  = SalarySetup::where('user_id',$request->user_id)->first();
        return $structure;
    }
}
