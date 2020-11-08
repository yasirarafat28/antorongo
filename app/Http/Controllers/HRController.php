<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HRController extends Controller
{
    //

    public function SalarySetup(Request $request)
    {
        return view('admin/hr-salary-setup');
    }
}
