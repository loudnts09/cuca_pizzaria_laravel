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
            'email.required' => 'O campo e-mail é obrigatório',
            'password.required' => 'O campo senha é obrigatório'
        ];

        $request->validate($regras, $feedbacks);

        $credenciais = [
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];

        Auth::logout();
            session()->flush();
            session()->regenerate();

        if(Auth::attempt($credenciais)){
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
