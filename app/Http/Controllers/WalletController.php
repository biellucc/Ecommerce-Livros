<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class WalletController extends Controller
{
    public function store(Request $request){

      $request->validate([
        'cvc' => 'required|string|regex:/^[0-9]{3,4}$/',
        'number_wallet' => 'required|string|regex:/^[0-9]{4}\s[0-9]{4}\s[0-9]{4}\s[0-9]{4}$/',
        'cart_validate' => 'required|date|after:' . Carbon::now()->toString(),
        'type_wallet' => 'required|string'
      ]);

      //dd($request->input('cart_validate'));
      $user = Auth::user();
      $customer = $user->customer;
      DB::table('wallets')->insert([
        'cvc' => $request->cvc,
        'number_wallet' => $request->number_wallet,
        'validate' => $request->cart_validate,
        'type_wallet' => $request->type_wallet,
        'customer_id' => $customer->id,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
      ]);

      return redirect()->route('wallet.lista');
    }

    public function formsWallet(){
        return View('Customer.formsWallet');
    }

    public function listarWallets() {
        $user = Auth::user();
        $wallets = Wallet::where('customer_id', $user->customer->id)
        ->orderBy('created_at', 'desc')
        ->get();

        return view('Customer.wallets', compact('wallets'));
    }

    public function walletUpdate(Request $request){
        $data = $request->session()->get('dados');
        $input = Arr::except($data, ['wallet_id', 'action']);
        $walletId = $data['wallet_id'];
        $wallet = Wallet::find($walletId);

        foreach ($input as $key => $value) {
            if ($wallet->offsetExists($key) && filled($value)) {
                $wallet->$key = $value;
            }
        }
        //dd($data, $input, $request);
        $wallet->save();

        $request->session()->forget('dados');

        return redirect()->route('wallet.lista');
    }

    public function rmWallet(Request $request) {
        $data = $request->session()->get('id');
        //dd($data);
        DB::delete('delete from wallets where id = ?', [$data]);
        $request->session()->forget('id');

        return redirect()->route('wallet.lista');
    }

    public function update_or_remove(Request $request) {
        $typeBtn = $request->input('action');
        if($typeBtn == 'Salvar'){
            //dd("salvar: ", $request->input('cvc'));
            return redirect()->route('wallet.up')->with('dados', $request->except('_token'));
        }else{
            $id = $request->input('wallet_id');
            //dd($typeBtn, "deletar");
            return redirect()->route('wallet.rm')->with('id', $id);
        }
    }

}
