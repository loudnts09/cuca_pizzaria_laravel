@extends('app.layouts.basico')

@section('conteudo')

<main class="d-flex justify-content-center align-items-center">
  <article class="container">
    <section class="d-flex justify-content-center">
      <div class="p-5 cor-de-fundo text-white rounded">
        <h3 class="mb-4">Cadastro de Novo Usuário</h3>

        <form action="{{ route('app.cadastro.create') }}" method="post" enctype="multipart/form-data">
          @csrf
          <!-- Foto do Usuário -->
          <div class="form-group mb-3">
            <label for="foto" class="form-label">Foto</label>
            <input type="file" name="foto" class="form-control" id="foto" accept="image/*">
          </div>

          <!-- Nome do Usuário -->
          <div class="form-group mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" name="nome" class="form-control" value="{{ old('nome')}}" id="nome" placeholder="Digite seu nome" required>
          </div>
          @if ($errors->has('nome'))
            <div class="text-danger">{{ $errors->first('nome') }}</div>
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
            <input type="senha" name="senha" class="form-control" value="{{ old('senha') }}" id="senha" placeholder="Digite sua senha" required>
          </div>
          @if ($errors->has('senha'))
            <div class="text-danger">{{ $errors->first('senha') }}</div>
          @endif

          <!-- Tipo de Perfil -->
          <div class="form-group mb-3">
            <label for="perfil" class="form-label">Tipo de Perfil</label>
              <select name="perfil" class="form-control" id="perfil" required>
                <option value="2" {{ old('perfil') == '2' ? 'selected' : '' }} >Usuário</option>
                <option value="1" {{ old('perfil') == '1' ? 'selected' : '' }} >Administrador</option>
            </select>
          </div>
          @if ($errors->has('perfil'))
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
              <a href="../index.php" class="btn btn-warning w-100">Voltar</a>
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
