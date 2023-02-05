@extends('layouts.plugins')

@extends('adminlte::page')

@section('title', 'Kardex')

@section('content_header')
@stop

@section('content')
<br>
    <link rel="stylesheet" href="css/pasteles.css">
    <div class="row justify-content-md-center">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                    <table class="table" id="kardex">
                        <thead class="myhead">
                            <tr>
                                <th>Item</th>
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

    </div>
@stop
@section('js')

<script>
    $(document).ready(function() {


        var table = $('#kardex').DataTable({
            responsive: true,
            autoWidth: false,
            "language": {
                "url": "{{ asset('idioma/es_dtable.json') }}"
            },
            pagingType: 'numbers',
            dom: 'Bfrtip',
            columnDefs: [{
                targets: 0,
                searchable: true,
                visible: false
            }],
            buttons: [

                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6],
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    }
                },

            ]
        });

        table.buttons().container()
            .appendTo('#kardex_wrapper .col-md-6:eq(0)');


    });
</script>

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
