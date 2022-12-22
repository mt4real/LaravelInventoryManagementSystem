<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Http\ScopeTraits\ScopeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory,ScopeTrait,SoftDeletes;


    public function checkPaidAmount(){
        if($this->paid_amount<$this->sales_amount){
            return true;
        }
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
       }

}
