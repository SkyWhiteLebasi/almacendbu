@extends('adminlte::page')

@section('title', 'Lista diaria')

@section('content_header')
    
    {{-- @can('salida.pdf_nutricion') --}}
        <a href="{{ url('salida/pdf_nutricion') }}" type="button" class="btn btn-pastel3"><i class="fas fa-file-pdf"></i>
            Imprimir mis salidas por validar</a>
    {{-- @endcan --}}

@stop

@section('content')
<br>
    <link rel="stylesheet" href="../css/pasteles.css">
    <div class="row justify-content-md-center">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table" id="example">
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
                                                    {{-- <td> {{ $salida->updated_at }} </td> --}}
                                                    <td>
                                                        {{-- @if(auth()->user()->rol=='admin') --}}
                                                        @can('salida.edit')
                                                        <a href="{{ url('/salida/'.$salida->id.'/edit'),  }}" class="btn btn-pastel1"><i class="fas fa-check"></i> Validar</a>
                                                {{-- |       @endif --}}
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
