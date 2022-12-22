<?php
namespace App\Http\Repository;

use App\Models\Payment;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class PaymentRepository{

    public function getUserPayment(){
        return Payment::where(['user_id'=>Auth::user()->id])->get();

    }

    public function getUserSalesPayment(){
        return Payment::where(['id'=>Session::get('sales_sessionId')])->first();

    }
}

