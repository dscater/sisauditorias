<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Trabajos de Auditoria</title>
    <style type="text/css">
        * {
            font-family: sans-serif;
        }

        @page {
            margin-top: 1.2cm;
            margin-bottom: 1.2cm;
            margin-left: 1.5cm;
            margin-right: 1.2cm;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            margin-top: 20px;
            page-break-before: avoid;
        }

        table thead tr th,
        tbody tr td {
            padding: 3px;
            word-wrap: break-word;
        }

        table thead tr th {
            font-size: 8pt;
        }

        table tbody tr td {
            font-size: 7pt;
        }


        .encabezado {
            width: 100%;
        }

        .logo img {
            position: absolute;
            height: 90px;
            top: -20px;
            left: 0px;
        }

        .logo2 img {
            position: absolute;
            height: 90px;
            top: -20px;
            right: 20px;
        }

        h2.titulo {
            width: 450px;
            margin: auto;
            margin-top: 0PX;
            margin-bottom: 15px;
            text-align: center;
            font-size: 14pt;
        }

        .texto {
            width: 250px;
            text-align: center;
            margin: auto;
            margin-top: 15px;
            font-weight: bold;
            font-size: 1.1em;
        }

        .fecha {
            width: 250px;
            text-align: center;
            margin: auto;
            margin-top: 15px;
            font-weight: normal;
            font-size: 0.85em;
        }

        .total {
            text-align: right;
            padding-right: 15px;
            font-weight: bold;
        }

        table {
            width: 100%;
        }

        table thead {
            background: rgb(236, 236, 236)
        }

        tr {
            page-break-inside: avoid !important;
        }

        .centreado {
            padding-left: 0px;
            text-align: center;
        }

        .datos {
            margin-left: 15px;
            border-top: solid 1px;
            border-collapse: collapse;
            width: 250px;
        }

        .txt {
            font-weight: bold;
            text-align: right;
            padding-right: 5px;
        }

        .txt_center {
            font-weight: bold;
            text-align: center;
        }

        .cumplimiento {
            position: absolute;
            width: 150px;
            right: 0px;
            top: 86px;
        }

        .b_top {
            border-top: solid 1px black;
        }

        .gray {
            background: rgb(236, 236, 236);
        }

        .bg-principal {
            background: #a73f52;
            color: white;
        }

        .txt_rojo {}

        .img_celda img {
            width: 45px;
        }

        .bold {
            font-weight: bold;
        }

        .derecha {
            text-align: right;
            padding-right: 3px;
        }

        .nueva_pagina {
            page-break-after: always;
        }

        .subtitulo {
            width: 100%;
            text-align: center;
            font-size: 10pt;
            font-weight: bold;
        }

        .mt-10 {
            margin-top: 10px;
        }

        .text-md {
            font-size: 7.7pt;
        }
    </style>
</head>

<body>
    @inject('institucion', 'App\Models\Institucion')
    @php
        $contador = 0;
    @endphp

    @foreach ($trabajo_auditorias as $trabajo_auditoria)
        <div class="encabezado">
            <div class="logo">
                <img src="{{ $institucion->first()->url_logo }}">
            </div>
            <div class="logo2">
                <img src="{{ $institucion->first()->url_logo2 }}">
            </div>
            <h2 class="titulo">
                {{ $institucion->first()->institucion }}
            </h2>
            <h4 class="texto">TRABAJOS DE AUDITORÍA</h4>
        </div>
        <table border="1">
            <tbody>
                <tr>
                    <td class="bold derecha" width="20%">Nombre de Auditoría:</td>
                    <td>{{ $trabajo_auditoria->nombre }}</td>
                    <td class="bold derecha" width="20%">Código de Control:</td>
                    <td>{{ $trabajo_auditoria->nombre }}</td>
                </tr>
                <tr>
                    <td class="bold derecha">Tipo de Trabajo de Auditoría:</td>
                    <td>{{ $trabajo_auditoria->tipo_trabajo->nombre }}</td>
                    <td class="bold derecha">Empresa:</td>
                    <td>{{ $trabajo_auditoria->empresa }}</td>
                </tr>
                <tr>
                    <td class="bold derecha">Gerente Responsable de Auditoría:</td>
                    <td>{{ $trabajo_auditoria->responsable->full_name }}</td>
                    <td class="bold derecha">Objeto:</td>
                    <td>{{ $trabajo_auditoria->objeto }}</td>
                </tr>
                <tr>
                    <td class="bold derecha">Objetivo:</td>
                    <td>{{ $trabajo_auditoria->objetivo }}</td>
                    <td class="bold derecha">Periodo que Abarca el Trabajo:</td>
                    <td>{{ $trabajo_auditoria->periodo }}</td>
                </tr>
                <tr>
                    <td class="bold derecha">Fecha de Inicio:</td>
                    <td>{{ $trabajo_auditoria->fecha_ini_t }}</td>
                    <td class="bold derecha">Días de Duración:</td>
                    <td>{{ $trabajo_auditoria->duracion }}</td>
                </tr>
                <tr>
                    <td class="bold derecha">Fecha de Entrega de Informe:</td>
                    <td>{{ $trabajo_auditoria->fecha_entrega_t }}</td>
                    <td class="bold derecha">Objeto:</td>
                    <td>{{ $trabajo_auditoria->objeto }}</td>
                </tr>
                <tr>
                    <td class="bold derecha">Fecha de Registro:</td>
                    <td colspan="3">{{ $trabajo_auditoria->fecha_registro_t }}</td>
                </tr>
            </tbody>
        </table>

        <div class="subtitulo mt-10">PERSONAL ASIGNADO</div>
        <table border="1" style="margin:auto;margin-top: 4px;width:60%;">
            <thead>
                <tr>
                    <th width="5%">N°</th>
                    <th>Personal</th>
                    <th width="15%">Horas Persupuesto</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $nro = 1;
                @endphp
                @foreach ($trabajo_auditoria->personal_trabajos as $personal_trabajo)
                    <tr>
                        <td class="centreado">{{ $nro + 1 }}</td>
                        <td>{{ $personal_trabajo->personal->full_name }}</td>
                        <td class="centreado">{{ $personal_trabajo->horas }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="subtitulo mt-10">ETAPAS DE LA AUDITOÍA</div>
        <table border="1" style="margin-top:4px;">
            <tbody>
                @php
                    $etapa_auditoria = $trabajo_auditoria->etapa_auditoria;
                    $etapa_nombres1 = [];
                    $etapa_nombres2 = [];
                    $etapa_nombres3 = [];

                    if ($etapa_auditoria) {
                        $etapa_nombres1 = App\Models\EtapaNombre::where('etapa_auditoria_id', $etapa_auditoria->id)
                            ->where('nro_etapa', 1)
                            ->get();

                        $etapa_nombres2 = App\Models\EtapaNombre::where('etapa_auditoria_id', $etapa_auditoria->id)
                            ->where('nro_etapa', 2)
                            ->get();

                        $etapa_nombres3 = App\Models\EtapaNombre::where('etapa_auditoria_id', $etapa_auditoria->id)
                            ->where('nro_etapa', 3)
                            ->get();
                    }
                @endphp
                <tr>
                    <td class="bold gray text-md">VALORACIÓN DEL RIESGO (PLANIFICACIÓN)</td>
                </tr>
                @if (count($etapa_nombres1) > 0)
                    @foreach ($etapa_nombres1 as $value)
                        <tr>
                            <td>{{ $value->nombre }} <br />({{ count($value->etapa_archivos) }} Archivos)</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="centreado"><i>Sin registros</i></td>
                    </tr>
                @endif
                <tr>
                    <td class="bold gray text-md">RESPUESTA AL RIESGO (EJECUCIÓN)</td>
                </tr>
                @if (count($etapa_nombres2) > 0)
                    @foreach ($etapa_nombres2 as $value)
                        <tr>
                            <td>{{ $value->nombre }} <br />({{ count($value->etapa_archivos) }} Archivos)</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="centreado"><i>Sin registros</i></td>
                    </tr>
                @endif
                <tr>
                    <td class="bold gray text-md">INFORME DE AUDITORÍA (DICTAMEN)</td>
                </tr>
                @if (count($etapa_nombres3) > 0)
                    @foreach ($etapa_nombres3 as $value)
                        <tr>
                            <td>{{ $value->nombre }} <br />({{ count($value->etapa_archivos) }} Archivos)</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="centreado"><i>Sin registros</i></td>
                    </tr>
                @endif
            </tbody>
        </table>
        <div class="subtitulo mt-10">PAPELES DE TRABAJO</div>
        <table border="1" style="margin-top:4px;">
            <tbody>
                @php
                    $papel_trabajo = $trabajo_auditoria->papel_trabajo;
                    $papel_detalles1 = [];
                    $papel_detalles2 = [];
                    $papel_detalles3 = [];

                    if ($papel_trabajo) {
                        $papel_detalles1 = App\Models\PapelDetalle::where('papel_trabajo_id', $papel_trabajo->id)
                            ->where('nro_etapa', 1)
                            ->orderBy('nro_nombre', 'asc')
                            ->get();

                        $papel_detalles2 = App\Models\PapelDetalle::where('papel_trabajo_id', $papel_trabajo->id)
                            ->where('nro_etapa', 2)
                            ->orderBy('nro_nombre', 'asc')
                            ->get();

                        $papel_detalles3 = App\Models\PapelDetalle::where('papel_trabajo_id', $papel_trabajo->id)
                            ->where('nro_etapa', 3)
                            ->orderBy('nro_nombre', 'asc')
                            ->get();
                    }
                @endphp
                <tr>
                    <td class="bold gray text-md">LEGAJO CORRIENTE (LC)</td>
                </tr>
                @if (count($papel_detalles1) > 0)
                    @foreach ($papel_detalles1 as $value)
                        <tr>
                            <td>{{ $value->nombre }} <br /> <span class="bold">Aplicabilidad: </span>{{$value->aplicabilidad}} &nbsp;&nbsp;&nbsp;&nbsp; <span class="bold">Estado: </span>{{$value->estado}} &nbsp;&nbsp;&nbsp; ({{ count($value->papel_archivos) }} Archivos)</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="centreado"><i>Sin registros</i></td>
                    </tr>
                @endif
                <tr>
                    <td class="bold gray text-md">LEGAJO RESUMEN (LR)</td>
                </tr>
                @if (count($papel_detalles2) > 0)
                    @foreach ($papel_detalles2 as $value)
                        <tr>
                            <td>{{ $value->nombre }} <br /> <span class="bold">Aplicabilidad: </span>{{$value->aplicabilidad}} &nbsp;&nbsp;&nbsp;&nbsp; <span class="bold">Estado: </span>{{$value->estado}} &nbsp;&nbsp;&nbsp; ({{ count($value->papel_archivos) }} Archivos)</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="centreado"><i>Sin registros</i></td>
                    </tr>
                @endif
                <tr>
                    <td class="bold gray text-md">LEGAJO PERMANENTE (LP)</td>
                </tr>
                @if (count($papel_detalles3) > 0)
                    @foreach ($papel_detalles3 as $value)
                        <tr>
                            <td>({{ count($value->papel_archivos) }} Archivos)</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="centreado"><i>Sin registros</i></td>
                    </tr>
                @endif
            </tbody>
        </table>
        @if ($contador < count($trabajo_auditorias) - 1)
            <div class="nueva_pagina"></div>
        @endif
    @endforeach
</body>

</html>
