<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'coupon_name', 'coupon_number', 'coupon_times','coupon_condition','coupon_code'
    ];
    protected $primaryKey = 'coupon_id';
 	protected $table = 'tbl_coupon';
}
