@extends('site.layouts.basico')

@section('titulo', $titulo)

@section('conteudo-header')

  <div class="d-flex align-items-center">
    <a href="#">
    <img src="../imagens/fatia.png" id="logo" class="navbar-brand" alt="logo pizza">
    </a>
    <h3 class="text-white">Peça já a sua pizza</h3>
  </div>
  <button class="navbar-toggler navbar-dark" type="button" data-bs-toggle="collapse" data-bs-target="#navegacao">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse justify-content-end" id="navegacao">
    <ul class="navbar-nav">
      <li><a href="#" class="nav-link link-secondary text-white">Sobre nós</a></li>
      <li><a href="../views/perfil.php" class="nav-link link-secondary text-white">Perfil</a></li>
      <li class="nav-item">
        <form action="{{ route('site.logoff') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" style="background: none; border: none; color: inherit; font: inherit; cursor: pointer;" class="nav-link link-secondary text-white">
                Sair
            </button>
        </form>
      </li>
    </ul>
  </div>

@endsection

@section('conteudo')

  <main class="d-flex justify-content-center align-items-center vh-100">
    <article class="container">
      <section class="d-flex justify-content-center">
        <div class="p-5 cor-de-fundo text-white rounded">
          <h3 class="mb-4">Bem-vindo à Pizzaria do Cuca!</h3>
          <p>Peça sua pizza favorita ou acompanhe seu pedido.</p>
          <div class="row mt-4">
            <div class="col-md-6 mb-3">
              <a href="{{ route('pedido.create') }}" class="btn btn-primary w-100">Fazer pedido</a>
            </div>
            <div class="col-md-6">
              <a href="{{ route('meus_pedidos.show') }}" class="btn btn-warning w-100">Meus Pedidos</a>
            </div>
          </div>
        </div>
      </section>
    </article>
  </main>

@endsection
