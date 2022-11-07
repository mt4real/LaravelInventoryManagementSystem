<?php
namespace App\Http\Repository;

use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class PaymentRepository{

    public function getUserPayment(){
        $user_payment=Payment::where(['user_id'=>Auth::user()->id])->get();
           return  $user_payment;
    }
}

