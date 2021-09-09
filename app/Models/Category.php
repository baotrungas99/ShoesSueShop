<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamp = false;
    protected $fillable = ['category_name','slug_category_product', 'meta_keywords','category_description','category_status', 'category_parent'];
    protected $primaryKey = 'category_id';
    protected $table = 'tbl_category_product';
}
