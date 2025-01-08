@extends('site.layouts.basico')

@section('titulo', $titulo)

@section('conteudo-header')

    <div class="d-flex align-items-center">
        <!--Logo-->
        <a href="#">
            <img src="imagens/fatia.png" id="logo" class="navbar-brand"alt="logo pizza">
        </a>
        <h3 class="text-white">Pizzaria do Cuca</h3>
    </div>

    <!--Botão-->
    <button class="navbar-toggler navbar-dark" type="button" data-bs-toggle="collapse" data-bs-target="#navegacao" >
        <span class="navbar-toggler-icon"></span>
    </button>

    <!--Link-->
    <div class="collapse navbar-collapse justify-content-end" id="navegacao">
        <ul class="navbar-nav navbar-dark">
            <li>
                <a href="{{ route('app.cadastro.create') }}" class="nav-link link-secondary text-white">Cadastre-se</a>
            </li>
            <li>
                <a href="#" class="nav-link link-secondary text-white">Sobre nós</a>
            </li>
        </ul>
    </div>

@endsection

@section('conteudo')
        
<main class="d-flex justify-content-center align-items-center vh-100">
    <article class="container">
        <section class="d-flex justify-content-center">
            <div class="p-5 cor-de-fundo form-container">
                <h3 class="text-white mb-4">Registre-se</h3>
                <form action="model/validar_login.php" method="post">
                    @csrf
                    <div class="form-floating my-2">
                        <label class="text-light" for="email_input">E-mail</label>
                        <input name="email" type="email" class="form-control" id="email_input" placeholder="digite seu email">
                    </div>
                    <div class="form-floating">
                        <label class="text-light" for="password_input">Senha</label>
                        <input name="senha" type="password" class="form-control" id="password_input" placeholder="digite sua senha">
                    </div>
                    <?php
                        if (isset($_GET["login"]) && $_GET["login"] == "erro") { ?>
                        
                            <div class="text-danger">
                            Usuário ou senha inválido(s)!
                            </div>

                    <?php } ?>
                    <?php
                        if (isset($_GET["usuario"]) && $_GET["usuario"] == "deletado") { ?>
                        
                            <div class="text-success">
                            Usuário excluído com sucesso!
                            </div>

                    <?php } ?>
                    <div class="form-check text-start my-2">
                        <input type="checkbox" class="form-check-input" id="check">
                        <label class="form-check-label text-white" for="check">Lembrar-me</label>
                    </div>
                    <button class="btn btn-primary w-100 py-2">Entrar</button>
                </form>
            </div>
        </section>
    </article>
</main>

@endsection