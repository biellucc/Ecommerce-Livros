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
        try{
            $request->validate([
                //User principal
                'email' => ['required', 'string', 'email', 'max:100', 'unique:' . User::class . ',email,' . $user->id],
                'phone' => ['required', 'string', 'max:20'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],

                //Address
                'state' => ['required', 'string', 'max:100'],
                'city' => ['required', 'string', 'max:100'],
                'neighborhood' => ['required', 'string', 'max:100'],
                'n_house' => ['required', 'integer'],
                'complement' => ['nullable', 'string', 'max:100'],
                'cep' => ['required', 'string', 'max:20'],

                //Tipo de user
                'userType' => ['required', Rule::in(['customer', 'vendor'])],
            ]);

            // Se for customer
            if ($request->input('userType') == 'customer') {
                $request->validate([
                    'firstName' => ['required', 'string', 'max:100'],
                    'lastName' => ['required', 'string', 'max:100'],
                    'cpf' => ['required'],
                    'agender' => ['required', Rule::in(['masculino', 'feminino'])],
                    'birthday' => ['required','date','before:' . Carbon::now()->subYears(16)->format('Y-m-d'),
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
                    'cnpj' => ['required'],
                    'nameBussines' => ['required', 'string', 'max:100'],
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
                    'agender' => $request->agender,
                ]);
            } else {
                $vendor = $user->vendor()->create([
                    'cnpj' => $request->cnpj,
                    'nameBussines' => $request->nameBussines,
                ]);
            }

            event(new Registered($user));

             Auth::login($user);

            return redirect(RouteServiceProvider::HOME);
        }catch(ValidationException $e){
            return redirect()->route('register')->with('error', 'Erro validação.')->withInput();
        }catch(QueryException $e){
            return redirect()->route('register')->with('error', 'Erro insert.')->withInput();
        }catch(Exception $e){
            return redirect()->route('register')->with('error', 'Erro geral.')->withInput();
        }
    }
}
