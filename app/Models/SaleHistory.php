<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\ScopeTraits\ScopeTrait;

class SaleHistory extends Model
{
    use HasFactory, ScopeTrait;

   public function addProduct(){

    return $this->belongsTo(AddProduct::class,'addProduct_id');
   }

   public function getTotalSalesHistoryProductAmount(){
    $balance=0;
    return $balance+=$this->quantity_sales*$this->sales_price;
}


}
