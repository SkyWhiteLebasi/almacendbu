@extends('adminlte::page')

@section('title', 'Mostrar Entrada')

@section('content_header')
@stop

@section('content')
<br>
    <link rel="stylesheet" href="../css/pasteles.css">
    <div class="row justify-content-md-center">
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead class="myhead">
                            <tr>
                                <th>Item</th>
                                <th>Número de orden</th>
                                <th>Producto</th>
                                <th>Número de Ingresos</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($consulta as $entrada)
                                <tr>
                                    <td> {{ $num++ }} </td>
                                    <td> {{ $entrada->producto->num_orden }} </td>
                                    <td> {{ $entrada->producto->nombre_pr }} </td>
                                    <td> {{ $entrada->mira }} </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                
            </div>
        </div>
    </div>

@endsection
