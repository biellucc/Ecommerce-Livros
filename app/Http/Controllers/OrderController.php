<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Wallet;
use Illuminate\Http\Request;

class OrderController extends Controller
{
   public function store_order(Request $request){

    //dd($request->input('wallet'));
    $request->validate([
        //Customer
        'firstName' => 'required|string|max:50',
        'lastName' => 'required:string|max:50',

        //User
        'email' => 'required:string|max:100',

        //Address
        'address' => 'required|string|max:80',
        'n_house' => 'required|integer|min:1',
        'complement'=> 'nullable|string',
        'state' => 'required|string|max:80',
        'city' => 'required|string|max:80',
        'cep' => 'required|string|regex:/^[0-9]{5}-[0-9]{3}$/',

        //Wallet
        'paymentMethod' => 'required',
        'wallet' => 'required'
    ]);

    $order = Order::class;
    $wallet = Wallet::find($request->input('wallet'));

    $order = $wallet->customer()->carts()->create([
        'value' => $request->input('value'),
        'cart_id' => $request->input('cart_id'),

    ]);

    return redirect()->route('carrinho');
   }

}
