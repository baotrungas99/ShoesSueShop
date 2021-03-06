<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'post_title', 'cate_post_id', 'post_desc','post_content','post_meta_desc','post_meta_keyword','post_image','post_status','post_slug'
    ];
    protected $primaryKey = 'post_id';
 	protected $table = 'tbl_post';
}
