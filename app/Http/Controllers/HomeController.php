<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        return view('site.home', ['titulo' => 'Home']);
    }

    public function autenticar(Request $request){
        
        $regras = [
            'email' => 'email',
            'senha' => 'required'
        ];

        $feedbacks = [
            'email.email' => 'O campo e-mail é obrigatório',
            'senha.required' => 'O campo senha é obrigatório'
        ];

        $request->validate($regras, $feedbacks);

        $credenciais = $request->only('email', 'senha');

        if(Auth::attempt($credenciais)){
            return redirect()->intended('site.home');
        }
        else{
            return redirect()->back()->route('site.login');
        }
    }

    public function logoff(){

        Auth::logout();

        return redirect()->route('site.login');
    }
}
