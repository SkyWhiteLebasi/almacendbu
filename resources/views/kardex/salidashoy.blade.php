@extends('adminlte::page')

@section('title', 'Salidas de hoy')

@section('content_header')
@stop

@section('content')
<br>
    <link rel="stylesheet" href="../css/pasteles.css">
    <div class="row justify-content-md-center">
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="myhead">
                                <tr>
                                    <th>Item</th>
                                    <th>Número de orden</th>
                                    <th>Nombre del Producto</th>
                                    <th>Cantidad de salida</th>
                                    <th>Observación</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($salidashoy as $salhoy)
                                    <tr>
                                        <td> {{ $num++ }} </td>
                                        <td> {{ $salhoy->num_orden }} </td>
                                        <td> {{ $salhoy->nombre_pr }} </td>
                                        <td> {{ $salhoy->cant_salida_val }} </td>
                                        <td> {{ $salhoy->obs_salida }} </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
                
            </div>
        </div>
    </div>

@endsection
