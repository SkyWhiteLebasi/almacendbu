@extends('layouts.plugins')

@extends('adminlte::page')

@section('title', 'Lista de salida diaria')

@section('content_header')
    <h4 style="color: #01729a"><b> Lista de Salida Diaria Generada por Nutrición</b></h4>

@stop

@section('content')
  
    <link rel="stylesheet" href="../css/pasteles.css">
    <div class="row justify-content-md-center">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="valnutricion">
                            <thead class="myhead">
                                <tr>
                                    <th>Id</th>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Fecha</th>
                                    <th>Observacion</th>
                                    {{-- <th>Modificacion</th> --}}
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($nutricion as $salida)
                                    {{-- @if ($pedido->semana_id == $sema->semana_id){ --}}
                                    <tr>

                                        <td> {{ $num++ }} </td>
                                        <td> {{ $salida->producto->nombre_pr }}</td>
                                        <td> {{ $salida->cant_salida }} </td>
                                        <td> {{ $salida->fecha_salida }} </td>
                                        <td> {{ $salida->obs_salida }} </td>
                                        <td>
                                            @can('salida.edit')
                                            <a href="{{ url('/salida/'.$salida->id.'/edit'),  }}" class="btn btn-pastel1"><i class="fas fa-check"></i> Validar</a>
                                   
                                            @endcan
                                            
                                            @can('salidanutricion.destroy')
                                            <form action="{{ url('/salida/' . $salida->id) }}"  class="d-inline form-eliminar"
                                                method="POST">
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


            var table = $('#valnutricion').DataTable({
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
                            columns: [0, 1, 2, 3, 4],
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    },

                ]
            });

            table.buttons().container()
                .appendTo('#valnutricion_wrapper .col-md-6:eq(0)');


        });
    </script>

    @if (session('guardar') == 'ok')
        <script>
            Swal.fire({
                // position: 'top-end',
                icon: 'success',
                title: 'Un producto de salida diaria creado exitosamente',
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
                title: 'Un producto de salida diaria modificado exitosamente',
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
