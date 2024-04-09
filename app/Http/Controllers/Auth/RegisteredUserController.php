<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Customer;
use App\Models\User;
use App\Models\Vendor;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Dotenv\Exception\ValidationException;
use Dotenv\Validator;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Validation\Rule;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    //Verificando os tipos de dados que foram passados no forms
    public function store(Request $request, User $user): RedirectResponse
    {

        $request->validate([
            //User principal
            'email' => ['required', 'string', 'email', 'max:100', 'unique:' . User::class . ',email,' . $user->id],
            'phone' => ['required', 'string', 'max:20'],
            'password' => ['required', 'confirmed', 'min:6', '', Rules\Password::defaults()],

            //Address
            'state' => ['required', 'string', 'max:80'],
            'city' => ['required', 'string', 'max:80'],
            'neighborhood' => ['required', 'string', 'max:80'],
            'n_house' => ['required', 'integer'],
            'complement' => ['nullable', 'string'],
            'cep' => ['required', 'string', 'regex:/^[0-9]{5}-[0-9]{3}$/'],

        ]);

        // Se for customer
        if ($request->input('userType') == 'customer') {
            $request->validate([
                'firstName' => ['required', 'string', 'max:50'],
                'lastName' => ['required', 'string', 'max:50'],
                'cpf' => ['required', 'regex:/^[0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2}$/'],
                'gender' => ['required'],
                'birthday' => [
                    'required', 'date', 'before:' . Carbon::now()->subYears(16)->format('Y-m-d'),
                    function ($attribute, $value, $fail) {
                        $age = Carbon::parse($value)->age;
                        if ($age < 16) {
                            $fail('A idade mínima é de 16 anos.');
                        }
                    },
                ],
            ]);
        } else {
            // Se for vendor
            $request->validate([
                'cnpj' => ['required', 'regex:/^[0-9]{2}.[0-9]{3}.[0-9]{3}\/[0-9]{4}-[0-9]{2}$/'],
                'nameBusiness' => ['required', 'string', 'max:80'],
            ]);
        }

        // Adicionando o User
        $user = User::create([
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        // Adicionando o Address
        $address = $user->address()->create([
            'cep' => $request->cep,
            'state' => $request->state,
            'city' => $request->city,
            'neighborhood' => $request->neighborhood,
            'n_house' => $request->n_house,
            'complement' => $request->input('complement') ?? null,
        ]);

        // Verificando se é um Customer ou Vendor e depois adicionando
        if ($request->input('userType') === 'customer') {
            $customer = $user->customer()->create([
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'cpf' => $request->cpf,
                'birthday' => $request->birthday,
                'gender' => $request->gender,
            ]);
        } else {
            $vendor = $user->vendor()->create([
                'cnpj' => $request->cnpj,
                'nameBusiness' => $request->nameBusiness,
            ]);
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('index');
    }
}
