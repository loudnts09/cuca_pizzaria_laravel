<?php

namespace App\Http\Controllers;

use App\Pedido;
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
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("app.pedido", ['titulo' => 'Meus Pedidos']);
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
            return redirect()->route('app.pedido', ['titulo', 'Meus Pedidos'])->with('mensagem','Pedido realizado com sucesso!');
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pedido  $Pedido
     * @return \Illuminate\Http\Response
     */
    public function show(Pedido $Pedido)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pedido  $Pedido
     * @return \Illuminate\Http\Response
     */
    public function edit(Pedido $Pedido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pedido  $Pedido
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pedido $Pedido)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pedido  $Pedido
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pedido $Pedido)
    {
        //
    }
}
