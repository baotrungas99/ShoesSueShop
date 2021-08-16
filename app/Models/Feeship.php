<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feeship extends Model
{
    public $timestamp = false;
    protected $fillable = [
       'fee_matp','fee_maqh','fee_xaid','fee_feeship'
    ];
    protected $primaryKey = 'fee_id';
    protected $table = 'tbl_fee_ship';

    public function Province(){
        return $this->belongsTo('App\Models\Province', 'fee_matp');
    }
    public function District(){
        return $this->belongsTo('App\Models\District', 'fee_maqh');
    }
    public function Ward(){
        return $this->belongsTo('App\Models\Ward', 'fee_xaid');
    }
}
