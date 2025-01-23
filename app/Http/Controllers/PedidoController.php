<?php

namespace App\Http\Controllers;

use App\Item_pedido;
use App\Pedido;
use App\Sabor;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pedido = strtolower($request->pedido);
        
        if(auth()->user()->perfil_id == 1){
            $pedidos = DB::table('itens_pedido')
                ->join('pedidos', 'itens_pedido.pedido_id', '=', 'pedidos.id')
                ->join('sabores', 'itens_pedido.sabor_id', '=', 'sabores.id')
                ->select('itens_pedido.*', 'pedidos.status_pedido as status_pedido','sabores.sabor as sabor')
                ->paginate(2);

            if($request->filled('pedido')){
                $pedidos = DB::table('itens_pedido')
                    ->join('pedidos','itens_pedido.pedido_id','=', 'pedidos.id')
                    ->join('sabores', 'itens_pedido.sabor_id', '=', 'sabores.id')
                    ->select('itens_pedido.*', 'pedidos.status_pedido as status_pedido','sabores.sabor as sabor')
                    ->where(function ($query) use($pedido){
                        $query->where('itens_pedido.pedido_id', $pedido)                  
                            ->orWhere('itens_pedido.tamanho', 'like', '%' . $pedido . '%')
                            ->orWhere('sabores.sabor', 'like', '%' . $pedido . '%')
                            ->orWhere('itens_pedido.observacao', 'like', '%' . $pedido . '%')
                            ->orWhere('pedidos.status_pedido', 'like', '%' . $pedido . '%');
                    })
                    ->paginate(2);
            }
        }
        else if(auth()->user()->perfil_id == 2){
            $pedidos = DB::table('itens_pedido')
                ->join('pedidos','itens_pedido.pedido_id','=', 'pedidos.id')
                ->join('sabores', 'itens_pedido.sabor_id', '=', 'sabores.id')
                ->select('itens_pedido.*', 'pedidos.status_pedido as status_pedido', 'pedidos.user_id','sabores.sabor as sabor')
                ->where('pedidos.user_id', auth()->user()->id)
                ->paginate(2);
            
            if($request->filled('pedido')){
                $pedidos = DB::table('itens_pedido')
                                ->join('pedidos', 'itens_pedido.pedido_id', '=', 'pedidos.id')
                                ->join('sabores', 'itens_pedido.sabor_id', '=', 'sabores.id')
                                ->select('itens_pedido.*', 'pedidos.status_pedido as status_pedido', 'pedidos.user_id', 'sabores.sabor as sabor')
                                ->where( 'pedidos.user_id', auth()->user()->id)
                                ->where(function ($query) use ($pedido){
                                    $query->where('itens_pedido.pedido_id', $pedido)
                                        ->orWhere('itens_pedido.tamanho', 'like', '%' . $pedido . '%')
                                        ->orWhere('sabores.sabor', 'like', '%' . $pedido . '%' )
                                        ->orWhere('itens_pedido.observacao', 'like', '%' . $pedido . '%')
                                        ->orWhere('pedidos.status_pedido', 'like', '%' . $pedido . '%');
                                })
                                ->paginate(2);
            }
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
        $sabores = Sabor::all();

        return view("app.pedido", compact('sabores'), [
            'titulo' => 'Meus Pedidos',
            'titulo_pagina' => 'Realizar pedido',
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
        $itensPedido = json_decode($request->input('itens_pedido'), true);

        
        if($itensPedido == null){
            return redirect()->back()->with('error', 'Não há pedidos para enviar');
        }
        
        $regras = [
            'itens_pedido.*.sabor_id' => 'required',
            'itens_pedido.*.tamanho' => 'required',
            'itens_pedido.*.quantidade' => 'required',
            'itens_pedido.*.observacao' => 'nullable'
        ];
        
        $feedbacks = [
            'required' => 'O campo :attribute deve ser preenchido'
        ];
        
        $request->validate($regras, $feedbacks);

        DB::beginTransaction();
        
        try{
            $pedido = Pedido::create([
                'user_id' => auth()->id(),
                'status_pedido' => 'em preparo'
            ]);
            
            foreach($itensPedido as $item){
                Item_pedido::create([
                    'pedido_id' => $pedido->id,
                    'sabor_id' => $item['sabor_id'],
                    'tamanho' => $item['tamanho'],
                    'quantidade' => $item['quantidade'],
                    'observacao' => isset($item['observacao']) ? strtolower($item['observacao']) : null
                ]);
            }

            DB::commit();

            session()->forget('itens_pedido');
            
            return redirect()->route('pedido.store', ['titulo', 'Meus Pedidos'])->with('mensagem','Pedido realizado com sucesso!');
        }
        catch(\Exception $e){
            DB::rollBack();

            return redirect()->back()->with('error', $e->getMessage());
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
    public function edit(Pedido $pedido, Item_pedido $item)
    {
        $sabores = Sabor::all();

        if(Auth::check()){
            if(Auth::user()->id == $pedido->user_id || (Auth::user()->perfil_id == 1)){
                $itensPedido = DB::table('itens_pedido')
                    ->join('sabores','itens_pedido.sabor_id','=','sabores.id')
                    ->select(   'sabores.sabor as sabor', 'tamanho', 'quantidade', 'observacao')
                    ->where('id', '=', $item->id);
                return view('app.pedido', ['titulo' => 'Meus Pedidos', 'titulo_pagina' => 'Realizar pedido'] ,compact('pedido', 'sabores', 'itensPedido'));
            }
            else{
                return redirect()->route('pedidos.index');
            }
        }
        else{
            return redirect()->route('site.login');
        }
        
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
            'observacao' => 'nullable'
        ];
        
        $feedbacks = [
            'required' => 'O campo :attribute deve ser preenchido'
        ];
        
        $request->validate($regras, $feedbacks);
        
        $dados = $request->all();
        
        $dados['status_pedido'] = 'Em preparo';

        try{
            $pedido->update($dados);
            return redirect()->route('pedido.create')->with('mensagem', 'Pedido atualizado com sucesso!');
        } catch(\Exception $e){
            return redirect()->route('pedido.create')->with('error', 'Não foi possível atualizar o pedido: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item_pedido $pedido)
    {
        try{
            DB::table('itens_pedido')->delete($pedido->id);
    
            return redirect()->route('pedidos.index')->with('mensagem', 'Pedido excluído com sucesso!');
        }
        catch(\Exception $e){
            return redirect()->route('pedidos.index')->with('error', 'Falha ao excluir item');
        }
    }
}
