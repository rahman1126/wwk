<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $table = 'coupons';
    protected $fillable = ['receipt_id','coupon_code'];

    public function receipt()
    {
    	return $this->belongsTo('App\Receipt');
    }
}
