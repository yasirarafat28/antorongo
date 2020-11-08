<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Setting extends Model
{
    //

    protected $table = 'setting';
    protected $primaryKey = 'id';

    public static function setting()
    {
        $setting = DB::table('setting')->where('status','active')->first();
        return $setting;
    }
}
