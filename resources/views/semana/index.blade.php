@extends('adminlte::page')

@section('title', 'Lista de Semana')

@section('content_header')
<div class="row justify-content-md-center">
    <div class="col-8">
        <h4 style="color: #01729a"><b> Lista de Semanas</b></h4>
    </div>
</div>
    <div class="row justify-content-md-center">
        <div class="col-8">
            @can('semana.create')
                <a href="{{ url('semana/create') }}" type="button" class="btn btn-pastel1"> <i class="fas fa-folder-plus"></i>
                    Registrar
                    semana</a>
            @endcan
        </div>
    </div>
@stop

@section('content')

    <link rel="stylesheet" href="css/pasteles.css">
    <div class="row justify-content-md-center">
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                    <table class="table">
                        <thead class="myhead">
                            <tr>
                                <th>Id</th>
                                <th>Nombre de Semana</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($semanas as $semana)
                                <tr>

                                    <td> {{ $num++ }} </td>
                                    <td> {{ $semana->nombre_semana }}</td>
                                    <td>
                                        {{-- @can('salida.destroy') --}}

                                        <form action="{{ url('/semana/' . $semana->id) }}" 
                                            class="d-inline form-eliminar" method="POST">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-pastel4"><i class="fas fa-trash-alt"></i>
                                                Borrar</button>
                                        </form>
                                        {{-- @endcan --}}

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
    @if (session('guardar') == 'ok')
        <script>
            Swal.fire({
                // position: 'top-end',
                icon: 'success',
                title: 'Semana creada exitosamente',
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
