<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    public $timestamp = false;
   protected $fillable = ['name_city','type'];
   protected $primaryKey = 'matp';
   protected $table = 'tbl_tinhthanhpho';
}