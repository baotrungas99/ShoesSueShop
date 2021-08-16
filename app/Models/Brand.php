<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
   public $timestamp = false;
   protected $fillable = ['brand_name','brand_slug','brand_description','brand_status'];
   protected $primaryKey = 'brand_id';
   protected $table = 'tbl_brand_product';
}
