<?php

namespace App\Http\Controllers;

use App\Item_pedido;
use App\Pedido;
use App\Sabor;
use App\User;
use Dompdf\Options;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

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

        $valorTamanhoItem = [
            'pequena' => 0.5,
            'media' => 1,
            'grande' => 1.5,
            'dfamilia'=> 2,
        ];

        $total = 0;
        
        if($itensPedido == null){
            return redirect()->back()->with('error', 'Não há pedidos para enviar');
        }
        
        $regras = [
            'itens_pedido.*.sabor_id' => 'required',
            'itens_pedido.*.tamanho' => 'required',
            'itens_pedido.*.quantidade' => 'required',
            'itens_pedido.*.observacao' => 'nullable|max:50'
        ];
        
        $feedbacks = [
            'required' => 'O campo :attribute deve ser preenchido',
            'max' => 'O campo :attribute deve conter no máximo 50 caracteres'
        ];
        
        $request->validate($regras, $feedbacks);
        
        DB::beginTransaction();
        
        try{

            $pedido = Pedido::create([
                'user_id' => auth()->id(),
                'status_pedido' => 'em preparo'
            ]);
            
            $sabores = [];
            $saboresPreco = [];

            foreach($itensPedido as $item){

                Item_pedido::create([
                    'pedido_id' => $pedido->id,
                    'sabor_id' => $item['sabor_id'],
                    'tamanho' => $item['tamanho'],
                    'quantidade' => $item['quantidade'],
                    'observacao' => isset($item['observacao']) ? strtolower($item['observacao']) : null
                ]);

                $precoItem = (Sabor::where($item['sabor_id'], '=', 'id')->value('preco') * $valorTamanhoItem[$item['tamanho']]) * $item['quantidade'];

                $sabores[$item['sabor_id']] = DB::table('sabores')->where('id', '=', $item['sabor_id'])->value('sabor');
                $saboresPreco[$item['sabor_id']] = $precoItem;

                $total += $precoItem;
            }
            
            Pedido::create([
                'valor' => $total
            ])->where('id', '=', $itensPedido['pedido_id']);
            
            if ($request->has('gerar_pdf')) {
                
                $pdf = new Dompdf();
                $options = new Options();
                $options->set('defaultFont', 'DejaVu Sans');
                $pdf->setOptions($options);
                
                $html = view('app.pdf.pedido', compact('pedido', 'itensPedido', 'sabores', 'saboresPreco', 'precoItem','total'))->render();
                $pdf->loadHtml($html);
                $pdf->setPaper('A4', 'portrait');
                $pdf->render();
                
                $saida = $pdf->output();
                $caminhoArquivo = 'public/pedidos/pedido_' . $pedido->id . '.pdf';
                Storage::put($caminhoArquivo, $saida);
                
                // Salva o caminho do PDF na sessão para download posterior
                session()->flash('caminho_pdf', 'pedidos/pedido_' . $pedido->id . '.pdf');
            }

            DB::commit();
            
            //remove os itens da sessão após serem processados e salvos no bd
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
    public function edit($item)
    {
        $sabores = Sabor::all();
                    
        if(Auth::check()){

            $pedido_id = Item_pedido::where('id', '=', $item)->value('pedido_id');

            $pedido_user = Pedido::where('id', '=', $pedido_id)->value('user_id');


            if($pedido_id && (Auth::user()->id == $pedido_user || Auth::user()->perfil_id == 1)){
                $item_pedido = DB::table('itens_pedido')
                    ->select(   'sabor_id', 'id' ,'tamanho', 'quantidade', 'observacao')
                    ->where('itens_pedido.id', '=', $item)
                    ->first();
                
                return view('app.pedido', compact( 'sabores', 'item_pedido'))->with([
                    'titulo' => 'Meus Pedidos',
                    'titulo_pagina' => 'Realizar pedido'
                ]);
            }
            else{
                return redirect()->route('pedidos.index')->with('mensagem', 'Não é possível editar o pedido');
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
    public function update(Request $request, $item_id)
    {

        $item = Item_pedido::find($item_id);
        
        $regras = [
            'sabor_id' => 'required',
            'tamanho' => 'required',
            'quantidade' => 'required',
            'observacao' => 'nullable'
        ];
        
        $feedbacks = [
            'required' => 'O campo :attribute deve ser preenchido'
        ];
        
        try{
            $request->validate($regras, $feedbacks);
            
            $dados = $request->only([
                'sabor_id', 'tamanho', 'quantidade', 'observacao'
            ]);
        
            $item->update($dados);

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
