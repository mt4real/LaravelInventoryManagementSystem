<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\ScopeTraits\ScopeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class SaleHistory extends Model
{
    use HasFactory, ScopeTrait, SoftDeletes;

   public function addProduct(){

    return $this->belongsTo(AddProduct::class,'addProduct_id');
   }

   public function user(){
    return $this->belongsTo(User::class,'user_id');
   }

   public function getTotalSalesHistoryProductAmount(){
    $balance=0;
    return $balance+=$this->quantity_sales*$this->sales_price;
}


}
