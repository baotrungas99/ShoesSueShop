<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'product_name', 'product_slug', 'product_quantity','category_id','brand_id','product_description','product_content','product_price','product_image','product_status','product_qty_sold'
    ];
    protected $primaryKey = 'product_id';
 	protected $table = 'tbl_product';
}
