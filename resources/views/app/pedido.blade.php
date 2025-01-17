@extends('site.layouts.basico')

@section('titulo', $titulo)

@section('conteudo-header')
  
  @include('app.layouts.header', ['titulo_pagina' => $titulo_pagina])

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
                <textarea name="observacao" class="form-control" id="ingredientes" placeholder="ex: borda de chocolate, manjericão..." style="height: 100px;">{{ isset($pedido) ? $pedido->observacao : "" }}</textarea>
              </div>
              @if(session('mensagem'))
              
                <div class="text-success m-1">
                  {{ session('mensagem') }}
                </div>
              
                @elseif(session('error'))

                <div class="text-success m-1">
                  {{ session('error') }}
                </div>
              @endif
              <div class="row mt-3">
                <div class="col-6">
                  <a class="btn btn-warning w-100 py-2" href="{{ route('pedidos.index') }}">Meus Pedidos</a>
                </div>
                <div class="col-6">
                  <button class="btn btn-success w-100 py-2" type="submit">{{ isset($pedido) ? 'Atualizar Pedido' : 'Enviar Pedido' }}</button>
                </div>
              </div>
            </form>
          </div>
        </section>
      </article>
    </main>

  @endsection