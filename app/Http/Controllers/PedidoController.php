<?php

namespace App\Http\Controllers;

use App\Pedido;
use App\User;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->perfil_id == 1){
            $pedidos = Pedido::paginate(2);
        }
        else if(User::where('perfil_id', 2)){
            $pedidos = Pedido::where('user_id', auth()->id())->paginate(2);
        }

        return view('app.exibir_pedido', compact('pedidos'), [
            'titulo' => 'Meus Pedidos',
            'titulo_pagina' => 'Consulta de Pedidos'
        ]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("app.pedido", [
            'titulo' => 'Meus Pedidos',
            'titulo_pagina' => 'Realizar pedido'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $regras = [
            'sabor' => 'required',
            'tamanho' => 'required',
            'observacao' => 'required'
        ];

        $feedbacks = [
            'required' => 'O campo :attribute deve ser preenchido'
        ];

        $request->validate($regras, $feedbacks);

        $dados = $request->all();
        $dados['user_id'] = auth()->id();
        $dados['status_pedido'] = 'Em preparo';

        try{
            Pedido::create($dados);
            return redirect()->route('pedido.store', ['titulo', 'Meus Pedidos'])->with('mensagem','Pedido realizado com sucesso!');
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function show(Pedido $pedido)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function edit(Pedido $pedido)
    {
        
        return view('app.pedido', ['titulo' => 'Meus Pedidos', 'titulo_pagina' => 'Realizar pedido'] ,compact('pedido'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pedido $pedido)
    {
        $regras = [
            'sabor' => 'required',
            'tamanho' => 'required',
            'observacao' => 'required'
        ];

        $feedbacks = [
            'required' => 'O campo :attribute deve ser preenchido'
        ];

        $request->validate($regras, $feedbacks);

        $dados = $request->all();
        $dados['status_pedido'] = 'Em preparo';

        $pedido->update($dados);

        return redirect()->route('pedido.create')->with('mensagem', 'Pedido atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pedido $pedido)
    {
        $pedido->delete();

        return redirect()->route('meus_pedidos.show')->with('mensagem', 'Pedido excluído com sucesso!');
    }
}
