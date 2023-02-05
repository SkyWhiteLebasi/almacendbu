@extends('adminlte::page')

@section('title', 'Mostrar Salida')

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
                                    <th>Id</th>
                                    <th>Producto</th>
                                    <th>Número de Salidas</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($salidas as $salida)
                                    <tr>
                                        <td> {{ $num++ }} </td>
                                        <td> {{ $salida->producto->nombre_pr }} </td>
                                        <td> {{ $salida->mira }} </td>

                                    </tr>
                                    {{-- {{$num++;}} --}}
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>
@stop
