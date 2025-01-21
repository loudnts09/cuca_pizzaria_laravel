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
            <h3 class="text-white">Faça seu Pedido</h3>
            <form method="post" action="{{ isset($pedido) ? route('pedido.update', $pedido->id) : route('pedido.store') }}">
              @csrf
              @if (isset($pedido))
                @method('PUT')
              @endif
              <div class="form-floating">
                <label for="sabor_id">Sabor</label>
                <select name="sabor_id[]" class="form-select w-100" id="sabor">
                  @foreach ($sabores as $opcoes)
                    <option value="{{$opcoes->id}}" {{ (isset($pedido) && $pedido->sabor_id == $opcoes->id) ? 'selected' : '' }}>{{ $opcoes->sabor }}</option>
                  @endforeach
                    <option value="Pequena" {{ (isset($pedido) && $pedido->sabor == 'Pequena') ? 'selected' : '' }}>Pequena</option>
                </select>
              </div>
              <div class="form-floating my-1">
                <label for="tamanho">Tamanho</label>
                <select name="tamanho[]" class="form-select w-100" id="tamanho">
                  <option value="Pequena" {{ (isset($pedido) && $pedido->tamanho == 'Pequena') ? 'selected' : '' }}>Pequena</option>
                  <option value="Média" {{ (isset($pedido) && $pedido->tamanho == 'Média') ? 'selected' : '' }}>Média</option>
                  <option value="Grande" {{ (isset($pedido) && $pedido->tamanho == 'Grande') ? 'selected' : '' }}>Grande</option>
                  <option value="Família" {{ (isset($pedido) && $pedido->tamanho == 'Família') ? 'selected' : '' }}>Família</option>
                </select>
              </div>
              <div class="form-floating my-1">
                <label for="quantidade">Quantidade</label>
                <select name="quantidade[]" class="form-select w-100" id="quantidade">
                  @for ($i = 1; $i <= 10; $i++)
                    <option value="{{ $i }}" {{ (isset($pedido) && $pedido->tamanho == 'Pequena') ? 'selected' : '' }}>{{ $i }}</option>
                  @endfor
                </select>
              </div>
              <div class="form-floating my-1">
                <label for="ingredientes">Ingredientes Adicionais</label>
                <textarea name="observacao" class="form-control" id="ingredientes" placeholder="Ex.: borda de chocolate, manjericão..." style="height: 50px;">{{ isset($pedido) ? $pedido->observacao : "" }}</textarea>
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
                  <button class="btn btn-info w-100 py-2" type="submit">{{ isset($pedido) ? 'Atualizar Pedido' : 'Adicionar Item' }}</button>
                </div>
              </div>
              <div class="mt-3">
                <button class="btn btn-success w-100 py-2" type="submit">{{ isset($pedido) ? 'Atualizar Pedido' : 'Enviar Pedido' }}</button>
              </div>
            </form>
          </div>
        </section>
      </article>
    </main>

  @endsection