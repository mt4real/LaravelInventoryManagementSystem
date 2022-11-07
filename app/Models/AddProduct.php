<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Database\Eloquent\SoftDeletes;

class AddProduct extends Model
{
    use HasFactory,SoftDeletes;



    public function getTotalProductAmount(){
        $balance=0;
        return $balance+=$this->product_quantity*$this->sale_price;
    }


    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }



    const PRODUCT_ACTIVE='ACTIVE';
    const PRODUCT_INACTIVE="INACTIVE";

}
