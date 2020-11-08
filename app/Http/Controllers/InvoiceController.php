<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function DepositInvoice()
    {
        return view('admin/invoice',compact('admission_fee'));
    }
}
