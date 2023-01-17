<html>

<head>
{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"> --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
    <!-- Defina bloques de encabezado y pie de página antes de su contenido -->
    <header>
        <img src="img/gibi.png" alt="" class="lefti">
        DIRECCIÓN DE BIENESTAR UNIVERSITARIO
        <img src="img/Logo_UNAP.png" alt="" class="righti">
        {{-- <hr style="margin: 25px"> --}}

    </header>
    <hr>
    <footer>
        Universidad Nacional del Altiplano © <?php echo date('Y-m-d'); ?>
    </footer>

    <!-- Envuelva el contenido de su PDF dentro de una etiqueta principal -->
    <main>

        <h4> Reporte de los productos de almacen</h4>
        <br>
        <div class="container-fluid">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Numero de orden</th>
                        <th>Nombre Producto</th>
                        <th>Unidad Medida</th>
                        <th>Categoria</th>
                        <th>Stock</th>

                    </tr>
                </thead>
                <tbody>
                    @php
                    $num=1;
                @endphp
                    @foreach ($productos as $producto)
                        <tr>



                            <td> {{ $num++ }} </td>
                        
                            <td> {{ $producto->num_orden }} </td>
                            <td> {{ $producto->nombre_pr }} </td>
                            <td> {{ $producto->medida->nombre_medida }} </td>
                            {{-- <td> {{$producto->$categoria->id}} </td> --}}
                            <td> {{ $producto->categoria->nombre_categoria }} </td>
                            <td> {{ $producto->stock }} </td>


                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>
