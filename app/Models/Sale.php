<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\ScopeTraits\ScopeTrait;

class Sale extends Model
{
    use HasFactory,ScopeTrait;

public function getTotalSalesProductAmount(){
    $balance=0;
    return $balance+=$this->quantity*$this->price;
}

public function addProduct(){

    return $this->belongsTo(AddProduct::class,'addProduct_id');
}


}
