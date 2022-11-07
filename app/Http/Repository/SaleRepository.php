<?php
namespace App\Http\Repository;

use App\Models\Sale;
use Illuminate\Support\Facades\Auth;

class SaleRepository{

    public function getUserSalesAmount(){
        $user_sales=Sale::where(['user_id'=>Auth::user()->id])->sum('total');
           return  $user_sales;
    }
}

