<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    protected $table = 'receipt';

    public function coupon()
    {
    	return $this->hasMany('App\Coupon');
    }
}
