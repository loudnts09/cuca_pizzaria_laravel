@extends('site.layouts.basico')

@section('titulo', $titulo)

@section('conteudo-header')

    @include('app.layouts.header', ['titulo_pagina' => $titulo_pagina])

@endsection

@section('conteudo')

    <!-- Container principal -->
    <main class="d-flex justify-content-center align-items-center vh-100">
        <div class="container">
            <div class="row">
                <div style="padding: 30px 0 0 0; width: 100%; margin: 0 auto;">
                    <div class="card cor-de-fundo text-white m-5">
                        <div class="col-md-12">
                            <form action="{{ route('pedidos.index') }}" method="get">
                                @csrf
                                <div class="card-header mt-2 row">
                                    <div class="col-md-11">
                                        <input type="text" class="form-control" name="pedido" placeholder="Buscar pedido" id="buscar_pedido">
                                    </div>
                                    <div class="col-md-1">
                                        <button type="submit" class="btn btn-primary  w-100 h-100" title="pesquisar">
                                            <i class="bi bi-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        <div class="card-header">
                            <h4>Pedidos Realizados:</h4>
                        </div>
                        <div class="card-body mb-3" style="max-height: 400px;">
                            <!-- Exemplo de pedido -->                                 
                            
                            @if (count($pedidos) == 0)
                                <h3 class="text-center">NAO HÁ PEDIDOS</h3>
                            @else
                                @foreach ($pedidos as $pedido)
                                    <div class="card bg-dark text-dark">
                                        <div class="card bg-light mb-1 text-dark">
                                            <h5 class="card-title m-3">Pedido: {{ $pedido->pedido_id }}</h5>
                                            <h6 class="card-subtitle mb-2 mx-3 text-muted">{{ $pedido->sabor }} - {{ $pedido->tamanho }}</h6>
                                            <p class="card-text mx-3">{{ $pedido->observacao }}</p>
                                            <p class="card-text mx-3 mb-2">Status: <span class="text-success">{{ $pedido->status_pedido }}</span></p>
                                            <div class="d-flex justify-content-end">
                                                <a href="{{ route('pedido.edit', $pedido->id) }}" class="btn btn-sm btn-primary mx-1">Editar</a>
                                                <form action="{{ route('pedido.destroy', $pedido->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                        <!-- Botão voltar e paginação -->
                        <div class="ml-2 mr-2 mb-3">
                            <div class="col-12">
                                {{ $pedidos->links() }}
                                @if(session('mensagem'))
                                    <div class="text-success m-1">
                                        {{ session('mensagem') }}
                                    </div>
                                @endif
                                @if (request()->has('pedido'))
                                    <a href="{{ route('pedidos.index') }}" class="btn btn-lg btn-warning" style="width: 100%;" >Voltar</a>
                                @else
                                    <a href="{{ route('home.index') }}" class="btn btn-lg btn-warning" style="width: 100%;" >Voltar</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection