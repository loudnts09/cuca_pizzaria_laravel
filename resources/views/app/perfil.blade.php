@extends('app.layouts.basico')

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
              <li><a href="{{ route('home.index') }}" class="nav-link link-secondary text-white">Home</a></li>
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

    <main class="d-flex justify-content-center align-items-center" style="padding-top: 100px; padding-bottom: 100px;">
      <article class="container">
        <section class="d-flex justify-content-center">
          <div class="p-5 cor-de-fundo text-white rounded">
            <h3 class="mb-4 text-center">Perfil do Usuario</h3>
            <form action="{{ route('pessoa.update', $pessoa->id) }}" method="post" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <!-- Foto do Usuário -->
              <div class="form-goup mb-3 text-center">
                <img src=" {{ asset('storage/' . $pessoa->foto) }}" alt="Foto do usuário" class="rounded-circle mb-3" width="120" height="120"><br>
              </div>

              <div class="form-group mb-3">
                <label for="foto" class="form-label">Foto</label>
                <input type="file" name="foto" class="form-control" id="foto" accept="image/*">
              </div>
              @if ($errors->has('foto'))
                <div class="text-danger">{{ $errors->first('foto') }}</div>
              @endif

              <!-- Nome do Usuário -->
              <div class="form-group mb-3">
                <label for="nome" class="form-label" >Nome</label>
                <input type="text" id="nome" name="name" class="form-control" placeholder="Seu nome" value="{{ $pessoa->name }}">
              </div>
              @if ($errors->has('name'))
                <div class="text-danger">{{ $errors->first('name') }}</div>
              @endif

              <!-- Número de Contato -->
              <div class="form-group mb-3">
                <label for="numero" class="form-label">Número de Telefone</label>
                <input type="tel" id="numero" name="telefone" class="form-control" placeholder="(XX) XXXXX-XXXX" value="{{ $pessoa->telefone }}">
              </div>
              @if ($errors->has('telefone'))
                <div class="text-danger">{{ $errors->first('telefone') }}</div>
              @endif

              <!-- CPF do Usuário -->
              <div class="form-group mb-3">
                <label for="cpf" class="form-label" >CPF</label>
                <input type="text" id="cpf" name="cpf" class="form-control" placeholder="Digite seu CPF" value="{{ $pessoa->cpf }}">
              </div>
              @if ($errors->has('cpf'))
                <div class="text-danger">{{ $errors->first('cpf') }}</div>
              @endif

              <!-- Email -->
              <div class="form-group mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="seu-email@exemplo.com" value="{{ $pessoa->email }}">
              </div>
              @if ($errors->has('email'))
                <div class="text-danger">{{ $errors->first('email') }}</div>
              @endif

              <!-- Senha -->
              <div class="form-group mb-3">
              <label for="senha" class="form-label">Senha</label>
              <input type="password" id="senha" name="password" class="form-control" placeholder="Sua senha">
              </div>
              @if ($errors->has('password'))
                <div class="text-danger">{{ $errors->first('password') }}</div>
              @endif

              <!-- Tipo de Perfil -->
              <div class="form-group mb-3">
                <label for="perfil" class="form-label">Tipo de Perfil</label>
                  <select id="perfil" name="perfil_id" class="form-control" required>
                    <option value="2" {{ $pessoa->perfil_id == 2 ? 'selected' : ""}} >Usuário</option>
                    <option value="1" {{$pessoa->perfil_id == 1 ? 'selected' : ""}} >Administrador</option>
                </select>
              </div>

              @if (session('mensagem'))
                  <div class="text-success m-1">
                    {{ session('mensagem') }}
                  </div>

              @elseif (session('error'))

                  <div class="alert alert-warning mt-4" role="alert">
                      {{ session('error') }}
                  </div>

              @endif

              <!-- Botões de Ação -->
              <div class="row mt-4">
                <div class="col-6">
                  <button type="submit" class="btn btn-warning w-100">Atualizar</button>
                </div>
            </form>
                <form class="col-6" action="{{ route('pessoa.destroy', $pessoa->id) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <div class=>
                    <button type="submit" class="btn btn-danger w-100">Excluir</button>
                  </div>
                </form>
              </div>
          </div>
        </section>
      </article>
    </main>

@endsection