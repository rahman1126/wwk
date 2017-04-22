<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table = 'images';
    protected $fillable = ['receipt_id','image_url'];
}
