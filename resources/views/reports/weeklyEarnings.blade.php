<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Reporte Semanal de Ganancias</title>
        <style>
            html{
                margin: 0;
                padding: 15px;
            }

            body {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                color: #020404;
                margin: 5;
                padding: 0;
             }

            .header {
            background-color: #a3c0d9;
            color: white;
            padding: 15px;
            text-align: center;
            border-bottom: 5px solid #15304b;
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

            #page_pdf {
                margin-top: 10%;
                margin: 40px;
            }

            p, label, span, table {
                font-family: 'Montserrat', sans-serif;
                font-size: 12pt;
            }

            .h2 {
                font-family: 'Montserrat', sans-serif;
                font-size: 17pt;
            }

            .h3 {
                font-weight: bold;
                font-family: 'Montserrat', sans-serif;
                font-size: 15pt;
                display: block;
                color: #0B1C80;
                text-align: left;
            }

            .textable {
                text-align: center;
                font-family: 'Montserrat', sans-serif;
                font-size: 12pt;
                color: #FFF;
            }

            .textcenter {
                padding: 5px;
                background-color: #FFF;
                text-align: center;
                font-size: 12pt;
                font-family: 'Montserrat', sans-serif;
            }

            #reporte_detalle {
                border-collapse: collapse;
                width: 100%;
                page-break-inside: auto;
                margin-bottom: 10px;
            }

            #reporte_detalle thead th {
                background: #0B1C80;
                color: #FFF;
                padding: 5px;
                page-break-inside: avoid;
                page-break-after: auto;
            }

            #detalle_ganancias tr {
                border-top: 1px solid #bfc9ff;
                page-break-inside: avoid;
            }


            .total_payment{
                    padding: 15px;
                    font-size: 13pt;
                    text-align: right;
                    font-family: 'Montserrat', sans-serif;
                    font-weight: bold;
            }

            .title {
                color: #03050c;
                font-family: 'Montserrat', sans-serif;
                font-size: 14pt;
                text-align: center;
            }

            .week_section {
                margin-top: 0px; 
                font-family: 'Montserrat', sans-serif;
                page-break-inside: avoid;
            }

            .total_earnings {
                position: absolute;
                font-family: 'Montserrat', sans-serif;
                font-size: 16pt;
                color: #05060f;
            }

        </style>
    </head>
    <body>
        <div id="page_pdf">

            <div class="header">
                <img src="img/gota.png" alt="Logo">
                <h1>COMITÉ DEL SISTEMA DE AGUA POTABLE, SANTIAGO TOLMAN A.C</h1>
            </div>

            <div class="title">
                <h3>GANANCIAS SEMANALES<h3>
            </div>
            @php
                $daysInSpanish = [
                    'Monday' => 'Lunes',
                    'Tuesday' => 'Martes',
                    'Wednesday' => 'Miércoles',
                    'Thursday' => 'Jueves',
                    'Friday' => 'Viernes',
                ];
            @endphp
            @foreach ($weeks as $week)
                <div class="week_section">
                    <p><strong>Semana del {{ \Carbon\Carbon::parse($week['start'])->translatedFormat('j \\d\\e F') }} al {{ \Carbon\Carbon::parse($week['end'])->translatedFormat('j \\d\\e F') }}</strong></p>
                    <table id="reporte_detalle">
                        <thead>
                            <tr>
                                @foreach ($daysInSpanish as $dayName)
                                    <th class="textcenter">{{ $dayName }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody id="detalle_ganancias">
                            <tr>
                                @foreach ($daysInSpanish as $dayEnglish => $dayName)
                                    @php
                                        $dayEarnings = $week['dailyEarnings'][$dayEnglish] ?? 0;
                                        $folio = $week['dailyFolios'][$dayEnglish] ?? null;
                                    @endphp
                                    <td class="textcenter">
                                        ${{ number_format($dayEarnings, 2) }}
                                        @isset($folio)
                                            <br><small>Folio: {{ $folio }}</small>
                                        @endisset
                                    </td>
                                @endforeach
                            </tr>
                            
                            <tr>
                                <td colspan="7" class="total_payment"><strong>Total de la semana:</strong> ${{ number_format(array_sum($week['dailyEarnings']), 2) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @endforeach
            <div class="total_earnings">
                <strong>Total del Periodo: ${{ number_format($totalPeriodEarnings, 2) }}</strong>
            </div>
        </div>
    </body>
</html>