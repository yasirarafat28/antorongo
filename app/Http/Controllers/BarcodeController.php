<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
//use peal\barcodegenerator\BarCode;
use peal\barcodegenerator\Facades\BarCode;

class BarcodeController extends Controller
{
    //

    public function test($id)
    {
        /*$members = User::where('role','member')->get();
        foreach ($members as $item)
        {
            $barcontent = BarCode::barcodeFactory("BarCode")
                ->renderBarcode(
                    $filepath ='',
                    $text=$item->unique_id,
                    $size='50',
                    $orientation="horizontal",
                    $code_type="code39", // code_type : code128,code39,code128b,code128a,code25,codabar
                    $print=true,
                    $sizefactor=1
                );
        }*/

        $user = User::find($id);

        $barcontent = BarCode::barcodeFactory("BarCode")
            ->renderBarcode(
                $filepath ='',
                $text=$user->unique_id,
                $size='60',
                $orientation="horizontal",
                $code_type="code39", // code_type : code128,code39,code128b,code128a,code25,codabar
                $print=true,
                $sizefactor=1
            );
        return '<img alt="testing" src="'.$barcontent.'"/>';

        //return view('admin/barcode',compact('img'));
    }
}
