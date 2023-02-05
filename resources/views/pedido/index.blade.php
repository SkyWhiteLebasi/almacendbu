@extends('layouts.plugins')
@extends('adminlte::page')

@section('title', 'Pedido')

@section('content_header')
<h4 style="color: #01729a"><b> Lista de Pedidos o Requerimientos Semanales</b></h4>
    @can('pedido.create')
        <a href="{{ url('pedido/create') }}" type="button" class="btn btn-pastel1"> <i class="fas fa-folder-plus"></i> Añadir
            pedido</a>
    @endcan
    @can('pedido.import-excel')
        <a href="{{ url('pedido/import-excel') }}" type="button" class="btn btn-pastel2"> <i class="fas fa-file-excel"></i>
            Importar</a>
    @endcan

@stop

@section('content')

    <link rel="stylesheet" href="css/pasteles.css">
    <div class="row justify-content-md-center">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table" id="pedido">
                            <thead class="myhead">
                                <tr>
                                    <th>Id</th>
                                    <th>Semana</th>
                                    <th>Unidad de Medida</th>
                                    <th>Producto</th>
                                    
                                    <th>Primera entrega</th>
                                    <th>Segunda entrega</th>
                                    <th>Cantidad Total</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($pedidos as $pedido)
                                    <tr>

                                        <td> {{ $num++ }} </td>
                                        <td> {{ $pedido->semana->nombre_semana }}</td>
                                        <td> {{ $pedido->medida->nombre_medida }}</td>
                                        <td> {{ $pedido->producto->nombre_pr }}</td>
                                        
                                        <td> {{ $pedido->primera_entrega }} </td>
                                        <td> {{ $pedido->segunda_entrega }} </td>

                                        <td> {{ $pedido->total_entrega }} </td>
                                        <td>
                                            @can('pedido.edit')
                                                <a href="{{ url('/pedido/'.$pedido->id.'/edit'),  }}" class="btn btn-pastel1"><i class="fas fa-pencil-alt"></i> Editar</a>
                                            @endcan
                                            @can('pedido.destroy')
                                                <form action="{{ url('/pedido/'.$pedido->id) }}"  class="d-inline form-eliminar" method ="POST">
                                                    @csrf
                                                    {{method_field('DELETE')}}
                                                    <button type="submit" class="btn btn-pastel4"><i class="fas fa-trash-alt"></i> Borrar</button>	
                                                </form>
                                            @endcan


                                        </td>

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


            var table = $('#pedido').DataTable({
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
                .appendTo('#pedido_wrapper .col-md-6:eq(0)');


        });
    </script>

    @if (session('guardar') == 'ok')
        <script>
            Swal.fire({
                // position: 'top-end',
                icon: 'success',
                title: 'pedido creado exitosamente',
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
                title: 'pedido modificado exitosamente',
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
                if (result.value) {

                    this.submit();
                }
            })
        });
    </script>

@endsection
