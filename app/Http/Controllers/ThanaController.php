<?php

namespace App\Http\Controllers;

use App\District;
use App\Thana;
use Illuminate\Http\Request;

class ThanaController extends Controller
{
    //
    public function getThana(Request $request)
    {
        $district_id = $request->district_id;
        $thanas = Thana::withCount('members')->where('district_id',$district_id)->orderBy('members_count','DESC')->get();
        return json_encode($thanas);
    }
}
