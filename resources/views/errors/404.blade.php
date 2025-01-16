<!-- resources/views/errors/404.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Página Não Encontrada</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f8f9fa;
            color: #6c757d;
            margin-top: 100px;
        }
        h1 {
            font-size: 3em;
            margin-bottom: 20px;
        }
        p {
            font-size: 1.2em;
        }
        a {
            text-decoration: none;
            color: #007bff;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>404 - Página Não Encontrada</h1>
    <p>Desculpe, a página que você está procurando não existe.</p>
    <a href="{{ route('home.index') }}">Voltar para a Página Inicial</a>
</body>
</html>
