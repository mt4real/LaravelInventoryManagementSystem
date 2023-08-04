<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\ScopeTraits\ScopeTrait;

class ProductSupplied extends Model
{
    use HasFactory, SoftDeletes, ScopeTrait;

    public function getTotalSuppliedAmount(){
        $balance=0;
        return $balance+=$this->quantity_supplied*$this->unit_price;
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    
}
