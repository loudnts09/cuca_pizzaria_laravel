@extends('site.layouts.basico')

@section('titulo', $titulo)

@section('conteudo-header')
  
  @include('app.layouts.header', ['titulo_pagina' => $titulo_pagina])

@endsection

  @section('conteudo')

    <main class="d-flex justify-content-center align-items-center">
      <article class="container row">
        <section class="col-8 d-flex justify-content-center">
          <div class="p-4 cor-de-fundo form-container text-white {{ session('mensagem') ? "com-mensagem" : "" }}">
            <h3 class="text-white">Faça seu Pedido</h3>
            <form method="post" action="{{ isset($pedido) ? route('pedido.update', $pedido->id) : route('item.store') }}">
              @csrf
              @if (isset($pedido))
              @method('PUT')
              @endif
              <div class="form-floating">
                <label for="sabor_id">Sabor</label>
                <select name="sabor_id" class="form-select w-100" id="sabor">
                  @foreach ($sabores as $opcoes)
                    <option value="{{$opcoes->id}}" {{ (isset($pedido) && $pedido->sabor_id == $opcoes->id) ? 'selected' : '' }}>{{ $opcoes->sabor }}</option>
                  @endforeach
                    <option value="Pequena" {{ (isset($pedido) && $pedido->sabor == 'Pequena') ? 'selected' : '' }}>Pequena</option>
                </select>
              </div>
              <div class="form-floating my-1">
                <label for="tamanho">Tamanho</label>
                <select name="tamanho" class="form-select w-100" id="tamanho">
                  <option value="Pequena" {{ (isset($pedido) && $pedido->tamanho == 'Pequena') ? 'selected' : '' }}>Pequena</option>
                  <option value="Média" {{ (isset($pedido) && $pedido->tamanho == 'Média') ? 'selected' : '' }}>Média</option>
                  <option value="Grande" {{ (isset($pedido) && $pedido->tamanho == 'Grande') ? 'selected' : '' }}>Grande</option>
                  <option value="Família" {{ (isset($pedido) && $pedido->tamanho == 'Família') ? 'selected' : '' }}>Família</option>
                </select>
              </div>
              <div class="form-floating my-1">
                <label for="quantidade">Quantidade</label>
                <select name="quantidade" class="form-select w-100" id="quantidade">
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

                <div class="text-danger m-1">
                  {{ session('error') }}
                </div>
              @endif
              <div class="row mt-3">
                <div class="col-6">
                  <a class="btn btn-warning w-100 py-2" href="{{ route('pedidos.index') }}">Meus Pedidos</a>
                </div>
                @if (!isset($pedido))
                  <div class="col-6">
                    <button class="btn btn-info w-100 py-2" type="submit" >Adicionar Item</button>
                  </div>
                @endif
              </div>
            </form>
          </div>
        </section>
        <section class="col-4 d-flex justify-content-center">
          <div class="p-4 cor-de-fundo form-container text-white {{ session('mensagem') ? "com-mensagem" : "" }}">
            <h3 class="mt-2">Itens Adicionados:</h3>
            @if (!session("itens_pedido"))
              <br><br><br><h3 class="text-center border border-white rounded">NAO HÁ PEDIDOS</h3>
            @else
              <ul class="list-group" style="max-height:400px; overflow-y: scroll;">
                @foreach (session("itens_pedido") as $index => $item)
                  <li class="list-group-item d-flex flex-column justify-content-between text-dark m-1">
                    <div class="row">
                      <div class="col-8">
                        <span>{{ $item['quantidade'] }}x {{ $item['tamanho'] }} - Sabor: {{ $sabores->firstWhere('id', $item['sabor_id'])->sabor }}</span><br>
                        @if (isset($item['observacao']))
                          <p style="word-wrap: break-word;">{{ $item['observacao'] }}</p>
                        @endif
                      </div>
                      <div class="col-2">
                        <form action="{{ route('item.destroy', $index) }}" method="post">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger btn-sm" >Remover</button>
                        </form>
                      </div>
                    </div>
                  </li>
                @endforeach
              </ul>
            @endif
            <form action="{{ route('pedido.store' ) }}" method="post">
              @csrf
              <input type="hidden" name="itens_pedido" value="{{ json_encode(session('itens_pedido')) }}">
              <div>
                <div class="mt-3">
                  <button class="btn btn-success w-100 py-2" type="submit">{{ isset($pedido) ? 'Atualizar Pedido' : 'Enviar Pedido' }}</button>
                </div>
                <div class="form-check mt-3 ml-1">
                  <input class="form-check-input" value="#" type="checkbox" id="exportar" style="transform: scale(1.5);">
                  <label class="form-check-label" for="exportar">
                    Exportar PDF
                  </label>
                </div>
              </div>
            </form>
          </div>
        </section>
      </article>
    </main>

  @endsection