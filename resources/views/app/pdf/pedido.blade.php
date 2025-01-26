<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Relatório do Pedido</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
        }
        .container {
            width: 100%;
            margin: 0 auto;
        }
        .header {
            text-align: center;
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .info-section {
            border-bottom: 1px solid #ccc;
            padding: 10px 0;
        }
        .info-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .info-content {
            font-size: 16px;
            margin-bottom: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .footer {
            text-align: center;
            font-size: 14px;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div>
            <?php
                $caminho = public_path('imagens/fatia.png');
                $tipo = pathinfo($caminho, PATHINFO_EXTENSION);
                $dado = file_get_contents($caminho);
                $base64 = 'data:image/' . $tipo . ';base64,' . base64_encode($dado);
            ?>
            <div class="d-flex align-items-center">
                <img src="{{ $base64 }}" id="logo" class="navbar-brand" alt="logo pizza" style="width:100px; height:auto;">
            </div>
        </div>
        <div class="header">
            Relatório do Pedido
        </div>

        <div class="info-section">
            <div class="info-title">Cliente</div>
            <div class="info-content">{{ $pedido->user->name }}</div>
        </div>

        <div class="info-section">
            <div class="info-title">Data do Pedido</div>
            <div class="info-content">{{ date('d/m/Y H:i', strtotime($pedido->created_at)) }}</div>
        </div>

        <div class="info-section">
            <div class="info-title">Status do Pedido</div>
            <div class="info-content">{{ $pedido->status_pedido }}</div>
        </div>

        <h3>Itens do Pedido</h3>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Sabor</th>
                    <th>Tamanho</th>
                    <th>Quantidade</th>
                    <th>Observação</th>
                    <th>N° do Pedido</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($itensPedido as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $sabores[$item['sabor_id']]}}</td>
                    <td>{{ $item['tamanho'] }}</td>
                    <td>{{ $item['quantidade'] }}</td>
                    <td>{{ $item['observacao'] ?? 'Nenhuma' }}</td>
                    <td>{{ $pedido->id}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="footer">
            Obrigado por comprar conosco!
        </div>
    </div>
</body>
</html>
