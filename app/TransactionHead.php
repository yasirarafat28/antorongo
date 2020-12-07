<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionHead extends Model
{
    //


    protected $table = 'transaction_head';
    protected $primaryKey = 'id';

    public function childs()
    {
        return $this->hasMany('App\TransactionHead','parent');
    }
    public function transactable_childs()
    {
        return $this->hasMany('App\TransactionHead','parent')->where('system_managable','no');

    }

    public function parent()
    {
        return $this->belongsTo('App\TransactionHead','parent');

    }

}
