<?php

namespace App\Http\Controllers;

use App\NumberConverter;
use App\SavingPackage;
use Illuminate\Http\Request;

class SavingPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $type)
    {
        //
        $records = SavingPackage::where('type',$type)->orderBy('target_amount','ASC')->get();

        return view('admin/saving-package/index',compact('records','type'));
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
        //

        $package = new SavingPackage();
        $package->name = $request->name;
        $package->type = $request->type;
        $package->target_amount = NumberConverter::bn2en($request->target_amount);
        $package->return_amount = NumberConverter::bn2en($request->return_amount);
        $package->installment_amount = NumberConverter::bn2en($request->installment_amount);
        $package->interest_rate = NumberConverter::bn2en($request->interest_rate);
        $package->installment_qty = NumberConverter::bn2en($request->installment_qty);
        $package->save();
        return back()->withSuccess('পাকেজ সফনভাবে যোগ করা হয়েছে!');
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
    public function update(Request $request,$type, $id)
    {
        //

        $package = SavingPackage::find($id);
        $package->name = $request->name;
        $package->target_amount = NumberConverter::bn2en($request->target_amount);
        $package->return_amount = NumberConverter::bn2en($request->return_amount);
        $package->installment_amount = NumberConverter::bn2en($request->installment_amount);
        $package->interest_rate = NumberConverter::bn2en($request->interest_rate);
        $package->installment_qty = NumberConverter::bn2en($request->installment_qty);
        $package->save();
        return back()->withSuccess('পাকেজ সফনভাবে এডিট করা হয়েছে!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($type,$id)
    {
        //
        $package = SavingPackage::destroy($id);
        return back()->withSuccess('পাকেজ সফনভাবে ডিলিট করা হয়েছে!');
    }



    public function getPackaesByType(Request $request)
    {


        $records = SavingPackage::where('type',$request->type)->get();
        return $records;
    }
}
