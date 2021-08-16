<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    public $timestamp = false;
    protected $fillable = ['name_xaphuong','type','maqh'];
    protected $primaryKey = 'xaid';
    protected $table = 'tbl_xaphuongthitran';
}
