<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Saving extends Model
{
    //

    protected $table = 'saving';
    protected $primaryKey = 'id';


    public function user()
    {
        return $this->belongsTo('App\User','user_id');

    }


    public function package()
    {
        return $this->belongsTo('App\SavingPackage','package_id');

    }

    public function identifier()
    {
        return $this->belongsTo('App\User','identifier_id');

    }


    public function histories(){
        return $this->hasMany('App\Transaction','transactable_id')->where('transaction_for','saving');
    }
    public function deposits(){
        return $this->hasMany('App\Transaction','transactable_id')->where('transaction_for','saving')->where('flag','deposit');
    }
    public function profits(){
        return $this->hasMany('App\Transaction','transactable_id')->where('transaction_for','saving')->where('flag','profit');
    }
    public function withdraws(){
        return $this->hasMany('App\Transaction','transactable_id')->where('transaction_for','saving')->where('flag','withdraw');
    }
}
