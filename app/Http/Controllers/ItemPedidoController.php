<?php

namespace App\Http\Controllers;

use App\Item_pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemPedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'sabor_id' => 'required',
            'tamanho' => 'required',
            'quantidade' => 'required',
            'observacao' => 'nullable'
        ];

        $feedback = [
            'required' => 'O campo :attribute é necessário'
        ];

        $request->validate($regras, $feedback);

        $item = [
            'sabor_id' => $request->sabor_id,
            'tamanho' => $request->tamanho,
            'quantidade' => $request->quantidade,
            'observacao' => $request->observacao
        ];

        
        session()->push('itens_pedido', $item);
        
        $sabor_escolhido[] = DB::table('sabores')->where('id', $request->sabor_id)->value('sabor');
        
        return redirect()->route('pedido.create')->with([
            'mensagem','Item adicionado com sucesso!',
            'sabor_escolhido' => $sabor_escolhido
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($index)
    {
        $itens = session('itens_pedido', []);

        unset($itens[$index]);

        session(['itens_pedido' =>array_values($itens)]);

        return redirect()->back()->with('menssagem', 'Item removido com sucesso!');
    }
}
