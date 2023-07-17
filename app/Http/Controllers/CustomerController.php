<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Customer;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    //Retorna para a página de carrinho do usuario
    public function carrinho(Cart $cart){
        $user = Auth::user();
        $carts = $cart->where('customer_id',$user->customer->user_id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('Customer.carrinho', compact('carts'));
    }

    //Vai para a página de pagamento
    public function comprar(){
        return View('Customer/comprar');
    }
}
