<html>

<head>

    <link rel="stylesheet" href="{{ asset('backend/dist/css/adminlte.min.css') }}">
    <style>
        /**
Establezca los márgenes de la página en 0, por lo que el pie de página y el encabezado
puede ser de altura y anchura completas.
**/
        @page {
            margin: 0cm 0cm;
        }

        /** Defina ahora los márgenes reales de cada página en el PDF **/
        body {
            margin-top: 2cm;
            margin-left: 1cm;
            margin-right: 1cm;
            margin-bottom: 2cm;
        }

        /** Definir las reglas del encabezado **/
        header {
            position: fixed;
            top: 0cm;
            left: 1cm;
            right: 1cm;
            height: 2cm;

            /** Estilos extra personales **/
            background-color: #ffffff;
            color: black;
            text-align: center;
            line-height: 1.5cm;
        }

        /** Definir las reglas del pie de página **/
        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;

            /** Estilos extra personales **/
            background-color: #012733;
            color: white;
            text-align: center;
            line-height: 1.5cm;
        }

        h4 {
            text-align: center;
        }

        .lefti {
            /* border: 1px solid #ddd; */
            /* border-radius: 2px; */
            padding: 3px;
            width: 90px;
            float: left;
        }

        .righti {
            /* border: 1px solid #ddd; */
            /* border-radius: 2px; */
            padding: 3px;
            width: 65px;
            float: right;
        }
    </style>
</head>

<body>
    <header>
        <img src="backend/dist/img/gibi.png" alt="" class="lefti">
        DIRECCIÓN DE BIENESTAR UNIVERSITARIO
        <img src="backend/dist/img/Logo_UNAP.png" alt="" class="righti">

    </header>
    <hr>
    <footer>
        Universidad Nacional del Altiplano © <?php echo date('Y-m-d'); ?>
    </footer>
    <!-- Envuelva el contenido de su PDF dentro de una etiqueta principal -->
    <main>
        <h4> Reporte de las salidas generadas por nutricion</h4>
        <br>
        <div class="container-fluid">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Fecha</th>
                        <th>Observacion</th>

                    </tr>
                </thead>
                <tbody>
                    @php
                        $num = 1;
                    @endphp
                    @foreach ($nutricion as $salida)
                        <tr>

                            <td> {{ $num++ }} </td>
                            <td> {{ $salida->nombre_pr }}</td>
                            <td> {{ $salida->cant_salida }} </td>
                            <td> {{ $salida->fecha_salida }} </td>
                            <td> {{ $salida->obs_salida }} </td>
                        </tr>

                        {{-- @endif   --}}
                    @endforeach

                </tbody>
            </table>
        </div>
    </main>
</body>

</html>
