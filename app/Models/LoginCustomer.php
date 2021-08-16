<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginCustomer extends Model
{
    public $timestamps = false;
    protected $fillable = [
          'customer_email',  'customer_name',  'customer_password','customer_phone'
    ];
    protected $primaryKey = 'customer_id';
 	protected $table = 'tbl_customers';
}
