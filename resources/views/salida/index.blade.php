@extends('adminlte::page')

@section('title', 'Lista de Salidas')

@section('content_header')
    <div class="row justify-content-md-center">
        <div class="col-12">
            @can('salida.create')
                <a href="{{ url('salida/create') }}" type="button" class="btn btn-pastel1"> <i class="fas fa-folder-plus"></i>
                    Registrar
                    una nueva salida</a>
            @endcan
            @can('salida.import-excel-alm')
                <a href="{{ url('salida/import-excel-alm') }}" type="button" class="btn btn-pastel2"> <i
                        class="fas fa-file-excel"></i> Importar excel validadas</a>
            @endcan
            <a href="{{ url('salida/pdf') }}" type="button" class="btn btn-pastel3"><i class="fas fa-file-pdf"></i>
                Imprimir</a>
        </div>
    </div>
@stop

@section('content')
    <link rel="stylesheet" href="css/pasteles.css">
    <div class="row justify-content-md-center">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <table class="table" id="salida">
                        <thead class="myhead">
                                        <tr>
                                            <th>Id</th>
                                            <th>Número de orden</th>
                                            <th>Producto</th>
                                            <th>Cantidad</th>
                                            <th>Fecha</th>
                                            <th>Observacion</th>
                                            
                                            {{-- <th>Modificacion</th> --}}
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        
                                        @foreach ($salidas as $salida)
                                            {{-- @if ($pedido->semana_id == $sema->semana_id){ --}}
                                            <tr>

                                                <td> {{ $num++ }} </td>
                                                <td> {{ $salida->producto->num_orden }}</td>
                                                <td> {{ $salida->producto->nombre_pr }}</td>
                                                <td> {{ $salida->cant_salida_val }} </td>
                                                <td> {{ $salida->fecha_salida }} </td>
                                                <td> {{ $salida->obs_salida }} </td>
                                                
                                                {{-- <td> {{ $salida->updated_at }} </td> --}}
                                                <td>
                                                    @can('salida.editdos')
                                                    <a href="{{ url('/salida/'.$salida->id.'/editdos'),  }}" class="btn btn-pastel1"><i class="fas fa-pencil-alt"></i> Editar</a>
                                                    @endcan
                                                    @can('salida.destroy')
                                                    <form action="{{ url('/salida/' . $salida->id) }}" id="form-eliminar" class="d-inline"
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
            @stop

            @section('js')
                @if (session('guardar') == 'ok')
                    <script>
                        Swal.fire({
                            // position: 'top-end',
                            icon: 'success',
                            title: 'Salida creado exitosamente',
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
                            title: 'Salida validada exitosamente',
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
                    $('#form-eliminar').submit(function(e) {

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
                <script>
                    $(document).ready(function() {
                        var table = $('#salida').DataTable({
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
