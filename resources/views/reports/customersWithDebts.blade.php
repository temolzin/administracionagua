<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes con deudas</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
        }
        .header {
            background-color: #a3c0d9;
            color: white;
            padding: 15px;
            text-align: center;
            border-bottom: 5px solid #0B1C80;
        }
        .header img {
            width: 80px;
            height: auto;
            vertical-align: middle;
        }
        .header h1 {
            display: inline;
            font-size: 12px;
            margin: 0;
            padding-left: 10px;
        }
      
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #dee2e6;
        }
        th, td {
            padding: 8px;
            text-align: left;
            font-size: 11px;
        }
        th {
            background-color: #0B1C80;
            color: white;
        }
        .title {
            text-align: center;
            margin: 20px 0;
            padding: 10px;
        }
        ul {
            list-style-type: none;
            padding-left: 0;
        }
    </style>
</head>
<body>

    <div class="header">
        <img src="img/gota.png" alt="Logo">
        <h1>COMITÉ DEL SISTEMA DE AGUA POTABLE, SANTIAGO TOLMAN A.C</h1>
    </div>
    <div class="title">
        <h3>Lista de clientes que tienen Deudas</h3>
    </div>

    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Total de la Deuda</th>
                </tr>
            </thead>
            <tbody>
                @foreach($customers as $customer)
                <tr>
                    <td>{{ $customer->id }}</td>
                    <td>{{ $customer->name }} {{ $customer->last_name }}</td>
                    <td>
                        @php
                        $unpaidDebts = $customer->debts->where('status', '!=', 'paid');
                        $totalDebt = $unpaidDebts->sum('amount');
                    @endphp
                        {{ number_format($totalDebt, 2) }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>
