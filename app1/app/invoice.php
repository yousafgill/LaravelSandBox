<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class invoice extends Model
{
    //
    public function customer(){
        return $this->belongsTo('App\customer','customerid','id');
    }
    public function invoicedetail(){
        return $this->hasMany('App\invoicedetail','invoicemainid','id');
    }
}