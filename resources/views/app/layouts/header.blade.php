<div class="d-flex align-items-center">
    <!-- Logo -->
    <a href="{{route('home.index')}}">
        <img src="{{ asset('imagens/fatia.png')}}" id="logo" class="navbar-brand" alt="logo pizza">
    </a>
    <h3 class="text-white">{{ $titulo_pagina }}</h3>
</div>

<!-- Botão Navbar -->
<button class="navbar-toggler navbar-dark" type="button" data-bs-toggle="collapse" data-bs-target="#navegacao">
    <span class="navbar-toggler-icon"></span>
</button>

<!-- Links Navbar -->
<div class="collapse navbar-collapse justify-content-end" id="navegacao">
    <ul class="navbar-nav">
        <li>
            <a href="{{ route('home.index') }}" class="nav-link link-secondary text-white">Home</a>
        </li>
        <li>
            <a href="#" class="nav-link link-secondary text-white">Sobre nós</a>
        </li>
        <li>
            <a href="{{ route('pessoa.index') }}" class="nav-link link-secondary text-white">Perfil</a>
        </li>
        <li>
            <a href="{{ route('site.logoff') }}" class="nav-link link-secondary text-white">Sair</a>
        </li>
    </ul>
</div>