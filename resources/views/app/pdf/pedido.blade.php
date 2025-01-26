<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Pedido</title>
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
            <div class="d-flex align-items-center">
                <img src="{{ public_path('public/imagens/fatia.png') }}" id="logo" class="navbar-brand" alt="logo pizza" style="width:100px; height:auto;">
            </div>
        </div>
        <div class="header">
            Relatório de Pedido
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
                </tr>
            </thead>
            <tbody>
                @foreach ($itensPedido as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item['sabor_id']}}</td>
                    <td>{{ $item['tamanho'] }}</td>
                    <td>{{ $item['quantidade'] }}</td>
                    <td>{{ $item['observacao'] ?? 'Nenhuma' }}</td>
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
