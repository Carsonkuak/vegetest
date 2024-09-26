<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function show($user_id)
    {
        $checkoutItems = Checkout::with('user', 'product')
                        ->where('user_id', $user_id)
                        ->get();

        return view('checkoutList', compact('checkoutItems'));
    }


}
