<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SliderModel extends Model
{
    public $timestamp = false;
   protected $fillable = ['slider_name','slider_image','slider_status','slider_desc'];
   protected $primaryKey = 'slider_id';
   protected $table = 'tbl_slider';
}
