<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\Category;

class Product extends Model


{
    protected $table="products";
    use HasFactory;

    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d h:i:s a');
    }

    public function getUpdatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d h:i:s a');
    }
    public function getTotalProductAmount(){
        $balance=0;
        return $balance+=$this->product_quantity*$this->sale_price;
    }



    public function categories(){
        return $this->hasMany(Category::class);
    }

    const PRODUCT_ACTIVE='ACTIVE';
    const PRODUCT_INACTIVE="INACTIVE";

}
