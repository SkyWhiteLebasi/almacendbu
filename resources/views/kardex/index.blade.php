@extends('adminlte::page')

@section('title', 'Kardex')

@section('content_header')
@stop

@section('content')
    <link rel="stylesheet" href="css/pasteles.css">
    <div class="row justify-content-md-center">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table" id="example">
                        <thead class="myhead">
                            <tr>
                                <th>Id</th>
                                <th>Numero de orden</th>
                                <th>Nombre del producto</th>
                                <th>Inventario inicial</th>
                                <th>Entradas</th>
                                <th>Salidas</th>
                                <th>Stock del producto</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productos as $producto)
                                <tr>
                                    <td> {{ $producto->id }} </td>
                                    <td> {{ $producto->num_orden }} </td>
                                    <td> {{ $producto->nombre_pr }} </td>
                                    <td> {{ $producto->inicial }} </td>
                                    <td> {{ $producto->entradas }} </td>
                                    <td> {{ $producto->salidas }} </td>
                                    <td> {{ $producto->stock }} </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>
@stop
@section('js')
<script >
    $(document).ready(function() {
  var table = $('#example').DataTable( {
      lengthChange: false,
      buttons: [
          {
              extend: 'csv',
              split: [ 'pdf', 'excel'],
          },
          'colvis'
      ]
  } );

  table.buttons().container()
      .appendTo( '#example_wrapper .col-md-6:eq(0)' );
} );
</script>   
@endsection
