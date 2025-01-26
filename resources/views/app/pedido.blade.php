@extends('site.layouts.basico')

@section('titulo', $titulo)

@section('conteudo-header')
  
  @include('app.layouts.header', ['titulo_pagina' => $titulo_pagina])

@endsection

  @section('conteudo')

    <main class="d-flex justify-content-center align-items-center">
      @if (!isset($item_pedido))
        <article class="container row">
      @else
        <article class="container">
      @endif
      @if (!isset($item_pedido))
        <section class="col-8 d-flex justify-content-center" style="max-height: 430px;">
      @else
        <section class="d-flex justify-content-center" style="max-height: 430px;">
      @endif
          <div class="p-4 cor-de-fundo form-container text-white {{ session('mensagem') ? "com-mensagem" : "" }}">
            <h3 class="text-white">Faça seu Pedido</h3> 
            <form method="post" action="{{ isset($item_pedido) ? route('pedido.update', $item_pedido->id) : route('item.store') }}">
              @csrf
              @if (isset($item_pedido))
                @method('PUT')
              @endif
              <div class="form-floating">
                <label for="sabor_id">Sabor</label>
                <select name="sabor_id" class="form-select w-100" id="sabor">
                  @foreach ($sabores as $opcoes)
                    <option value="{{$opcoes->id}}" {{ (isset($item_pedido) && $item_pedido->sabor_id == $opcoes->id) ? 'selected' : '' }}>{{ $opcoes->sabor }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-floating my-1">
                <label for="tamanho">Tamanho</label>
                <select name="tamanho" class="form-select w-100" id="tamanho">
                  <option value="Pequena" {{ (isset($item_pedido) && $item_pedido->tamanho == 'Pequena') ? 'selected' : '' }}>Pequena</option>
                  <option value="Média" {{ (isset($item_pedido) && $item_pedido->tamanho == 'Média') ? 'selected' : '' }}>Média</option>
                  <option value="Grande" {{ (isset($item_pedido) && $item_pedido->tamanho == 'Grande') ? 'selected' : '' }}>Grande</option>
                  <option value="Família" {{ (isset($item_pedido) && $item_pedido->tamanho == 'Família') ? 'selected' : '' }}>Família</option>
                </select>
              </div>
              <div class="form-floating my-1">
                <label for="quantidade">Quantidade</label>
                <select name="quantidade" class="form-select w-100" id="quantidade">
                  @for ($i = 1; $i <= 10; $i++)
                    <option value="{{ $i }}" {{ (isset($item_pedido) && $item_pedido->quantidade == $i) ? 'selected' : '' }}>{{ $i }}</option>
                  @endfor
                </select>
              </div>
              <div class="form-floating my-1">
                <label for="ingredientes">Observações (50 caracteres)</label>
                <textarea name="observacao" maxlength="50" class="form-control" id="ingredientes" placeholder="Ex.: borda de chocolate, manjericão..." style="height: 50px;">{{ isset($item_pedido) ? $item_pedido->observacao : "" }}</textarea>
                @if ($errors->has('observacao'))
                 <div class="text-danger">{{ $errors->first('observacao') }}</div>
                @endif
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
                @if (!isset($item_pedido))
                  <div class="col-6">
                    <button class="btn btn-info w-100 py-2" type="submit" >Adicionar Item</button>
                  </div>
                @else
                  <div class="col-6">
                    <button class="btn btn-success w-100 py-2" type="submit">Atualizar Pedido</button>
                  </div>
                @endif
              </div>
            </form>
          </div>
        </section>
        @if(!isset($item_pedido))
          <section class="col-4 d-flex justify-content-center" style="max-height: 430px;">
            <div class="p-4 cor-de-fundo form-container text-white {{ session('mensagem') ? "com-mensagem" : "" }}">
              <h3 class="mt-2">Itens Adicionados:</h3>
              @if (!session("itens_pedido"))
                <br><br><br><h3 class="text-center border border-white rounded">NAO HÁ ITENS</h3>
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
              @if(session('caminho_pdf'))
                <div class="mt-3" id="exportar">
                    <a href="{{ asset('storage/' . session('caminho_pdf')) }}" class="btn btn-primary" download>
                        Baixar PDF do Pedido
                    </a>
                </div>
              @endif
              <form action="{{ route('pedido.store' ) }}" style="margin-top: auto;" method="post">
                @csrf
                <input type="hidden" name="itens_pedido" value="{{ json_encode(session('itens_pedido')) }}">
                <div>
                  <div class="mt-3">
                    @if (!session('caminho_pdf'))
                      <div class="form-check mt-3 ml-1">
                        <input class="form-check-input" value="1" name="gerar_pdf" type="checkbox" id="exportar" style="transform: scale(1.5);">
                        <label class="form-check-label" for="exportar">
                          Exportar PDF
                        </label>
                      </div>
                    @endif
                    <button class="btn btn-success w-100 py-2 mt-2" type="submit">{{ isset($pedido) ? 'Atualizar Pedido' : 'Enviar Pedido' }}</button>
                  </div>
                </div>
              </form>
            </div>
          </section>
        @endif
      </article>
    </main>

  @endsection