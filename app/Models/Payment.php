<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Payment extends Model
{
    use HasFactory;


    public function checkPaidAmount(){
        if($this->paid_amount<$this->sales_amount){
            return true;
        }
    }
}
