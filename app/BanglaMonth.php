<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BanglaMonth extends Model
{
    //

    public static function MonthName($key){
        switch ($key) {
            case 1:
                return 'জানুয়ারী ';
            case 2:
                return 'ফেব্রুয়ারী  ';
            case 3:
                return 'মার্চ  ';
            case 4:
                return 'এপ্রিল  ';
            case 5:
                return 'মে  ';
            case 6:
                return 'জুন  ';
            case 7:
                return 'জুলাই ';
            case 8:
                return 'আগস্ট  ';
            case 9:
                return 'সেপ্টেম্বর  ';
            case 10:
                return 'অক্টোবর ';
            case 11:
                return 'নভেম্বর  ';
            default:
                return "ডিসেম্বর";
        }
    }
}
