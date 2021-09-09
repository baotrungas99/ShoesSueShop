<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryPost extends Model
{
    public $timestamp = false;
    protected $fillable = ['cate_post_name','cate_post_slug', 'meta_keywords','cate_post_desc','cate_post_status','updated_at','created_at'];
    protected $primaryKey = 'category_post_id';
    protected $table = 'tbl_category_post';
}
