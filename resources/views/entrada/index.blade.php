@extends('layouts.plugins')

@extends('adminlte::page')

@section('title', 'Entradas')

@section('content_header')
<h4 style="color: #01729a"><b> Lista de Registro de Entradas</b></h4>
    <div class="row justify-content-md-center">
        <div class="col-12">
            @can('entrada.create')
                <a href="{{ url('entrada/create') }}" type="button" class="btn btn-pastel1"> <i class="fas fa-folder-plus"></i>
                    Registrar
                    una nueva entrada</a>
            @endcan
            @can('entrada.import-excel')
                <a href="{{ url('entrada/import-excel') }}" type="button" class="btn btn-pastel2"> <i
                        class="fas fa-file-excel"></i> Importar excel</a>
            @endcan
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
                        <table class="table" id="entrada">
                            <thead class="myhead">
                                <tr>
                                    <th>Item</th>
                                    <th>Número de Orden</th>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Fecha</th>
                                    <th>Observacion</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($entradas as $entrada)
                                    <tr>

                                        <td> {{ $num++ }} </td>
                                        <td> {{ $entrada->producto->num_orden }}</td>
                                        <td> {{ $entrada->producto->nombre_pr }}</td>
                                        <td> {{ $entrada->cant_entrada_val }} </td>
                                        <td> {{ $entrada->fecha_entrada }} </td>
                                        <td> {{ $entrada->obs_entrada }} </td>
                                        {{-- <td> {{ $entrada->validador }} </td> --}}
                                        <td>
                                            @can('entrada.edit')
                                            <a href="{{ url('/entrada/'.$entrada->id.'/edit'),  }}" class="btn btn-pastel1"><i class="fas fa-pencil-alt"></i> Editar</a>
                                            @endcan
                                            @can('entrada.destroy')
                                            <form action="{{ url('/entrada/' . $entrada->id) }}"   class="d-inline form-eliminar"
                                                method="POST">
                                                            @csrf
                                                {{method_field('DELETE')}}
                                                <button type="submit" class="btn btn-pastel4"><i class="fas fa-trash-alt"></i> Borrar</button>	
                                            </form>
                                            @endcan

                                        </td>

                                    </tr>

                                    {{-- @endif   --}}
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


            var table = $('#entrada').DataTable({
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
                .appendTo('#entrada_wrapper .col-md-6:eq(0)');


        });
    </script>

    @if (session('guardar') == 'ok')
        <script>
            Swal.fire({
                // position: 'top-end',
                icon: 'success',
                title: 'Entrada creado exitosamente',
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
                title: 'Entrada modificado exitosamente',
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

@endsection
