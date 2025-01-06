<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <title>Pizzaria do Cuca - Cadastro de Usuário</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('style.css')}}">
    <link rel="icon" href="{{ asset('imagens/fatia.png')}}">
    <style>
      main {
        padding-top: 100px;
        padding-bottom: 100px;
      }
    </style>
  </head>

  <body>
    <header class="m-5">
      <nav class="navbar navbar-expand-md cor-de-fundo fixed-top">
        <div class="container">
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
            <a href="../index.php" class="nav-link link-secondary text-white">Login</a>
          </div>
        </div>
      </nav>
    </header>


    @yield('conteudo')


    <footer class="cor-de-fundo text-white py-3">
        <div class="container">
          <div class="row">
            <div class="col-6">
              <p class="mb-2">Pizzaria do Cuca © 2024</p>
              <a href="#" class="text-white me-3">Política de Privacidade</a>
              <a href="#" class="text-white me-3">Termos de Uso</a>
            </div>
            <div class="col-6">
              <a href="#" class="text-white me-3 fs-4"><i class="bi bi-whatsapp"></i></a>
              <a href="#" class="text-white me-3 fs-4"><i class="bi bi-instagram"></i></a>
              <a href="#" class="text-white fs-4"><i class="bi bi-twitter"></i></a>
            </div>
          </div>
        </div>
    </footer>
  
      <!-- Bootstrap JavaScript Libraries -->
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
  </body>
</html>