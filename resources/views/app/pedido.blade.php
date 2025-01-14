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
      <ul class="navbar-nav navbar-dark">
        <li><a href="{{ route('home.index') }}" class="nav-link link-secondary text-white">Home</a></li>
        <li><a href="#" class="nav-link link-secondary text-white">Sobre nós</a></li>
        <li><a href="../controller/ler_usuario.php" class="nav-link link-secondary text-white">Perfil</a></li>
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
    <main class="d-flex justify-content-center align-items-center">
      <article class="container">
        <section class="d-flex justify-content-center">
          <div class="p-4 cor-de-fundo form-container text-white {{ session('mensagem') ? "com-mensagem" : "" }}">
            <h3 class="text-white mb-4">Faça seu Pedido</h3>
            <form method="post" action="{{ isset($pedido) ? route('pedido.update', $pedido->id) : route('pedido.store') }}">
              @csrf
              @if (isset($pedido))
                @method('PUT')
              @endif
              <div class="form-floating my-1">
                <label for="nome_da_pizza">Nome da Pizza</label>
                <input name="sabor" type="text" class="form-control" id="nome_da_pizza" placeholder="ex: calabresa, marguerita..." value="{{ isset($pedido) ? $pedido->sabor : ""}}" required>
              </div>
              <div class="form-floating my-1">
                <select name="tamanho" class="form-select" id="tamanho">
                  <option value="Pequena" {{ (isset($pedido) && $pedido->tamanho == 'Pequena') ? 'selected' : '' }}>Pequena</option>
                  <option value="Média" {{ (isset($pedido) && $pedido->tamanho == 'Média') ? 'selected' : '' }}>Média</option>
                  <option value="Grande" {{ (isset($pedido) && $pedido->tamanho == 'Grande') ? 'selected' : '' }}>Grande</option>
                  <option value="Família" {{ (isset($pedido) && $pedido->tamanho == 'Família') ? 'selected' : '' }}>Família</option>
                </select>
                <label for="tamanho">Tamanho</label>
              </div>
              <div class="form-floating my-1">
                <label for="ingredientes">Ingredientes Adicionais</label>
                <textarea name="observacao" class="form-control" id="ingredientes" placeholder="ex: borda de chocolate, manjericão..." style="height: 100px;" required>{{ isset($pedido) ? $pedido->observacao : "" }}</textarea>
              </div>
              @if(session('mensagem'))
              
                <div class="text-success m-1">
                  {{ session('mensagem') }}
                </div>
              
                @elseif(session('erro'))

                <div class="text-success m-1">
                  {{ session('erro') }}
                </div>
              @endif
              <div class="row mt-3">
                <div class="col-6">
                  <a class="btn btn-warning w-100 py-2" href="{{ route('home.index') }}">Voltar</a>
                </div>
                <div class="col-6">
                  <button class="btn btn-primary w-100 py-2" type="submit">{{ isset($pedido) ? 'Atualizar Pedido' : 'Enviar Pedido' }}</button>
                </div>
              </div>
            </form>
          </div>
        </section>
      </article>
    </main>

  @endsection