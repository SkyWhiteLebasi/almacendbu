@extends('adminlte::page')

@section('title', 'Productos con poco stock')

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
                                    <th>Número de Orden</th>
                                    <th>Producto</th>
                                    <th>Medida</th>
                                    <th>Categoria</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pocos as $pocstock)
                                    <tr>
                                        <td> {{ $num++ }} </td>
                                        <td> {{ $pocstock->num_orden }} </td>
                                        <td> {{ $pocstock->nombre_pr }} </td>
                                        <td> {{ $pocstock->nombre_medida }} </td>
                                        <td> {{ $pocstock->nombre_categoria }} </td>
                                        <td> {{ $pocstock->stock }} </td>
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
