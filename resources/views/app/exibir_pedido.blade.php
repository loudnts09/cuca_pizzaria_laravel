@extends('site.layouts.basico')

@section('titulo', $titulo)

@section('conteudo-header')

    <div class="d-flex align-items-center">
        <!-- Logo -->
        <a href="#">
            <img src="../imagens/fatia.png" id="logo" class="navbar-brand" alt="logo pizza">
        </a>
        <h3 class="text-white">Consulta de Pedidos</h3>
    </div>

    <!-- Botão Navbar -->
    <button class="navbar-toggler navbar-dark" type="button" data-bs-toggle="collapse" data-bs-target="#navegacao">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Links Navbar -->
    <div class="collapse navbar-collapse justify-content-end" id="navegacao">
        <ul class="navbar-nav">
            <li>
                <a href="{{ route('home.index') }}" class="nav-link link-secondary text-white">Home</a>
            </li>
            <li>
                <a href="#" class="nav-link link-secondary text-white">Sobre nós</a>
            </li>
            <li>
                <a href="../views/perfil.php" class="nav-link link-secondary text-white">Perfil</a>
            </li>
            <li>
                <a href="{{ route('site.logoff') }}" class="nav-link link-secondary text-white">Sair</a>
            </li>
        </ul>
    </div>

@endsection

@section('conteudo')

    <!-- Container principal -->
    <main class="d-flex justify-content-center align-items-center vh-100">
        <div class="container">
            <div class="row">
                <div style="padding: 30px 0 0 0; width: 100%; margin: 0 auto;">
                    <div class="card cor-de-fundo text-white m-5">
                        <div class="card-header">
                            <h4>Pedidos Realizados:</h4>
                        </div>
                        <div class="card-body mb-3" style="max-height: 400px;">
                            <!-- Exemplo de pedido -->                                 
                            
                            @if (count($pedidos) == 0)
                                <h3 class="text-center">NAO HÁ PEDIDOS</h3>
                            @else
                                @foreach ($pedidos as $pedido)
                                    <div class="card bg-dark text-dark mt-2">
                                        <div class="card bg-light text-dark">
                                            <h5 class="card-title m-3">{{ $pedido->id }}</h5>
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
                                <a href="{{ route('home.index') }}" class="btn btn-lg btn-warning" style="width: 100%;" >Voltar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection