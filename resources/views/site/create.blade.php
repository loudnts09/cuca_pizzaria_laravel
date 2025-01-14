@extends('site.layouts.basico')

@section('titulo', $titulo)

@section('conteudo-header')

  <div class="d-flex align-items-center">
    <a href="home.php">
      <img src="../imagens/fatia.png" id="logo" class="navbar-brand" alt="logo pizza">
    </a>
    <h3 class="text-white">Peça já a sua pizza</h3>
  </div>
  <button class="navbar-toggler navbar-dark" type="button" data-bs-toggle="collapse" data-bs-target="#navegacao">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse justify-content-end" id="navegacao">
    <a href="{{ route('site.login') }}" class="nav-link link-secondary text-white">Login</a>
  </div>
  </div>

@endsection


@section('conteudo')

<main class="d-flex justify-content-center align-items-center" style="padding-top: 100px; padding-bottom: 100px;">
  <article class="container">
    <section class="d-flex justify-content-center">
      <div class="p-5 cor-de-fundo text-white rounded">
        <h3 class="mb-4">Cadastro de Novo Usuário</h3>

        <form action="{{ route('cadastro.store') }}" method="post" enctype="multipart/form-data">
          @csrf
          <!-- Foto do Usuário -->
          <div class="form-group mb-3">
            <label for="foto" class="form-label">Foto</label>
            <input type="file" name="foto" class="form-control" value="{{ old('foto') }}" id="foto" accept="image/*">
          </div>
          @if ($errors->has('foto'))
            <div class="text-danger">{{ $errors->first('foto') }}</div>
          @endif

          <!-- Nome do Usuário -->
          <div class="form-group mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" name="name" class="form-control" value="{{ old('name')}}" id="nome" placeholder="Digite seu nome" required>
          </div>
          @if ($errors->has('name'))
            <div class="text-danger">{{ $errors->first('name') }}</div>
          @endif

          <!-- Número de Contato -->
          <div class="form-group mb-3">
            <label for="telefone" class="form-label">Número de Contato</label>
            <input type="text" name="telefone" class="form-control" value="{{ old('telefone') }}" id="telefone" placeholder="Digite seu número" required>
          </div>
          @if ($errors->has('telefone'))
            <div class="text-danger">{{ $errors->first('telefone') }}</div>
          @endif

          <!-- CPF -->
          <div class="form-group mb-3">
            <label for="cpf" class="form-label">CPF</label>
            <input type="text" name="cpf" class="form-control" value="{{ old('cpf') }}" id="cpf" placeholder="Digite seu CPF" required>
          </div>
          @if ($errors->has('cpf'))
            <div class="text-danger">{{ $errors->first('cpf') }}</div>
          @endif

          <!-- Email -->
          <div class="form-group mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" id="email" placeholder="seu-email@gmail.com" required>
          </div>
          @if ($errors->has('email'))
            <div class="text-danger">{{ $errors->first('email') }}</div>
          @endif

          <!-- Senha -->
          <div class="form-group mb-3">
            <label for="senha" class="form-label">Senha</label>
            <input type="password" name="password" class="form-control" value="{{ old('password') }}" id="senha" placeholder="Digite sua senha" required>
          </div>
          @if ($errors->has('senha'))
            <div class="text-danger">{{ $errors->first('senha') }}</div>
          @endif

          <!-- Tipo de Perfil -->
          <div class="form-group mb-3">
            <label for="perfil_id" class="form-label">Tipo de Perfil</label>
              <select name="perfil_id" class="form-control" id="perfil_id" required>
                <option value="2" {{ old('perfil_id') == '2' ? 'selected' : '' }} >Usuário</option>
                <option value="1" {{ old('perfil_id') == '1' ? 'selected' : '' }} >Administrador</option>
            </select>
          </div>
          @if ($errors->has('perfil_id'))
            <div class="text-danger">{{ $errors->first('perfil') }}</div>
          @endif

          @if (session('mensagem'))
            <div class="alert alert-success mt-4" role="alert">
              Cadastro realizado com sucesso!
            </div>
          @elseif (session('erro'))
            <div class="alert alert-danger mt-4" role="alert">
              Falha ao realizar cadastro!
            </div>
          @endif

          <!-- Botões de Ação -->
          <div class="row mt-4">
            <div class="col-6">
              <a href="{{ route('site.index') }}" class="btn btn-warning w-100">Voltar</a>
            </div>
            <div class="col-6">
              <button type="submit" class="btn btn-success w-100">Cadastrar</button>
            </div>
          </div>
        </form>
      </div>
    </section>
  </article>
</main>

@endsection
