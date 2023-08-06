<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\NovoPedido;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'telemovel' => ['required', 'numeric', 'regex:/^(\+?351)?9\d{8}$/u', 'unique:users'],
            'dataNascimento' => ['required', 'date'],
            'genero' => ['required', 'in:masculino,feminino'],
        ]);
    }


    public function register(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $role_id = $request->input('tipo_registro') === 'professor' ? 2 : 3;

        $estado = $request->input('tipo_registro') === 'aluno' ? 1 : 0 ;

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'telemovel' => $request->input('telemovel'),
            'dataNascimento' => $request->input('dataNascimento'),
            'genero' => $request->input('genero'),
            'associado' => false, // Set default value to 0
        ]);

        $user->role_id = $role_id;
        $user->associado = 0;
        $user->estado = $estado;
        $user->save();

        if ($request->input('tipo_registro') === 'professor') {
            return redirect()->route('confirmacao');
        }

        return redirect()->route('login');
    }

    public function confirmacao()
    {
        return view('confirmacao');
    }
}
