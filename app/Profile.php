<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Profile extends Model
{
    //

    public static function completeness($user_id)
    {
        $total_field= 20;
        $count = 0;
        $user = User::find($user_id);

        if ($user->name){
            $count++;
        }
        if ($user->email){
            $count++;
        }
        if ($user->phone){
            $count++;
        }
        if ($user->phone_2){
            $count++;
        }
        if ($user->father_name){
            $count++;
        }
        if ($user->education_qualification){
            $count++;
        }
        if ($user->dob){
            $count++;
        }
        if ($user->blood_group){
            $count++;
        }
        if ($user->photo){
            $count++;
        }
        if ($user->sinature){
            $count++;
        }
        if ($user->address){
            $count++;
        }
        if ($user->division){
            $count++;
        }
        if ($user->district){
            $count++;
        }
        if ($user->thana){
            $count++;
        }
        if ($user->nominee_name){
            $count++;
        }
        if ($user->nominee_phone){
            $count++;
        }
        if ($user->nominee_dob){
            $count++;
        }
        if ($user->nominee_relation){
            $count++;
        }
        if ($user->nominee_photo){
            $count++;
        }
        if ($user->nominee_sinature){
            $count++;
        }

        $score = $count/$total_field *100;
        return $score;
    }
}
