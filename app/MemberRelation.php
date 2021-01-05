<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemberRelation extends Model
{
    //

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
    public function releted_user(){
        return $this->belongsTo('App\User','releted_user_id');
    }
    public static function releted_user_ids($user_id){
        $ids  = MemberRelation::where('user_id',$user_id)->get(['releted_user_id'])->pluck('releted_user_id')->toArray();
        return $ids;
    }
}
