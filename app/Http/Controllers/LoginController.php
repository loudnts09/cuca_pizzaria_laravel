<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        
        return view('site.login', ['titulo' => 'Login']);
    }

    public function login(Request $request){
        
        $regras = [
            'email' => 'required|email',
            'password' => 'required'
        ];

        $feedbacks = [
            'email.email' => 'Digite um e-mail válido',
            'required' => 'O campo :attribute é obrigatório'
        ];

        $request->validate($regras, $feedbacks);

        $credenciais = [
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];

        $remember = $request->has('remember');

        if(Auth::attempt($credenciais, $remember)){
            return redirect()->intended('/home');
        }
        else{
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['login' => 'Credenciais inválidas']);
        }
    }

}
