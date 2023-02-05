@extends('layouts.plugins')
@extends('adminlte::page')

@section('title', 'Lista de Productos')

@section('content_header')
<h4 style="color: #01729a"><b> Lista de Registro de Productos</b></h4>
    <div class="row">
        <div class="col-6">
            
            @can('producto.create')
                <a href="{{ url('producto/create') }}" type="button" class="btn btn-pastel1"> <i class="fas fa-folder-plus"></i>
                    Crear
                    producto</a>
            @endcan
            @can('producto.import-excel')
                <a href="{{ url('producto/import-excel') }}" type="button" class="btn btn-pastel2"> <i
                        class="fas fa-file-excel"></i>
                    Importar</a>
            @endcan

        </div>
        <div class="col-6">
            <form method="GET">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Ingrese texto a buscar">
                    <div class="input-group-append">
                        <button class="btn btn-pastel5" type="submit"><i class="fas fa-search"></i>
                            Buscar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@stop

@section('content')


    <link rel="stylesheet" href="css/pasteles.css">
    <div class="row justify-content-md-center">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                    <table class="table" id="producto">
                        <thead class="myhead">

                            <tr>
                                <th>Item</th>
                                {{-- <th>Foto</th> --}}
                                <th>Numero de orden</th>
                                <th>Nombre Producto</th>
                                <th>Unidad Medida</th>
                                <th>Categoria</th>
                                <th>Stock</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($productos->isNotEmpty())
                                @foreach ($productos as $producto)
                                    <tr>



                                        <td> {{ $num++ }} </td>

                                        <td> {{ $producto->num_orden }} </td>
                                        <td> {{ $producto->nombre_pr }} </td>
                                        <td> {{ $producto->medida->nombre_medida }} </td>
                                        <td> {{ $producto->categoria->nombre_categoria }} </td>
                                        <td> {{ $producto->stock }} </td>
                                        <td>
                                            @can('producto.create')
                                            <a href="{{ url('/producto/'.$producto->id.'/edit'),  }}" class="btn btn-pastel1"><i class="fas fa-pencil-alt"></i> Editar</a>	
                                            @endcan
                                            @can('producto.destroy')
                                            <form action="{{ url('/producto/'.$producto->id) }}"  class="d-inline form-eliminar" method ="POST">
                                                @csrf
                                                {{method_field('DELETE')}}
                                                <button type="submit" class="btn btn-pastel4"><i class="fas fa-trash-alt"></i> Borrar</button>	
                                            </form>
                                            @endcan
                                        </td>
                                        {{-- @endif --}}
                                    </tr>
                                @endforeach
                            @else
                                <h5>No se encontro resultados</h5>

                            @endif

                        </tbody>

                    </table>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {


            var table = $('#producto').DataTable({
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
                            columns: [0, 1, 2, 3, 4, 5],
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        }
                    },

                ]
            });

            table.buttons().container()
                .appendTo('#producto_wrapper .col-md-6:eq(0)');


        });
    </script>
    @if (session('guardar') == 'ok')
        <script>
            Swal.fire({
                // position: 'top-end',
                icon: 'success',
                title: 'Producto creado exitosamente',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif
    @if (session('editar') == 'ok')
        <script>
            Swal.fire({
                // position: 'top-end',
                icon: 'success',
                title: 'Producto modificado exitosamente',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif
    @if (session('eliminar') == 'ok')
        <script>
            Swal.fire(
                'Eliminado!',
                'Se ha eliminado exitosamente',
                'success'
            )
        </script>
    @endif



    <script type="text/javascript">
        $('.form-eliminar').submit(function(e) {

            e.preventDefault();


            Swal.fire({
                title: '¿Está seguro?',
                text: "No será capaz de revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminarlo!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {

                    this.submit();
                }
            })
        });
    </script>

    <script>
        $(document).ready(function() {
            var table = $('#example').DataTable({
                lengthChange: false,
                buttons: [{
                        extend: 'csv',
                        split: ['pdf', 'excel'],
                    },
                    'colvis'
                ]
            });

            table.buttons().container()
                .appendTo('#example_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection
