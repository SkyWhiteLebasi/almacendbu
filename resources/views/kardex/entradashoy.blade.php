@extends('adminlte::page')

@section('title', 'Entradas de hoy')

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
                                    <th>Cantidad de entrada</th>
                                    <th>Observación</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($entradashoy as $enthoy)
                                    <tr>
                                        <td> {{ $num++ }} </td>
                                        <td> {{ $enthoy->num_orden }} </td>
                                        <td> {{ $enthoy->nombre_pr }} </td>
                                        <td> {{ $enthoy->cant_entrada_val }} </td>
                                        <td> {{ $enthoy->obs_entrada }} </td>
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
