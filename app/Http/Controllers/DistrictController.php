<?php

namespace App\Http\Controllers;

use App\District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    //

    public function getDistrict(Request $request)
    {
        $division_id = $request->division_id;
        $districts = District::where('division_id',$division_id)->get();
        return json_encode($districts);
    }
}
