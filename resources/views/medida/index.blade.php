@extends('adminlte::page')

@section('title', 'Medida')

@section('content_header')

<div class="row justify-content-md-center">
    <div class="col-8">
        <h4 style="color: #01729a"><b> Lista de Medidas</b></h4>
    </div>
</div>
    <div class="row justify-content-md-center">
        <div class="col-8">
            @can('medida.create')
                <a href="{{ url('medida/create') }}" type="button" class="btn btn-pastel1"> <i class="fas fa-folder-plus"></i>
                    Registrar
                    una nueva medida</a>
            @endcan
        </div>
    </div>
@stop

@section('content')


    @if (Session::has('mensaje'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('mensaje') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <link rel="stylesheet" href="css/pasteles.css">
    <div class="row justify-content-md-center">
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                    <table class="table" id="example">
                        <thead class="myhead">
                            <tr>
                                <th>Id</th>
                                <th>Nombre de Medida</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($medidas as $medida)
                                <tr>

                                    <td> {{ $num++ }} </td>
                                    <td> {{ $medida->nombre_medida }}</td>
                                    <td>
                                        @can('medida.destroy')
                                            <form action="{{ url('/medida/' . $medida->id) }}" id="form-eliminar"
                                                class="d-inline form-eliminar" method="POST">
                                                @csrf
                                                {{ method_field('DELETE') }}
                                                <button type="submit" class="btn btn-pastel4"><i class="fas fa-trash-alt"></i>
                                                    Borrar</button>
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
    @if (session('guardar') == 'ok')
        <script>
            Swal.fire({
                // position: 'top-end',
                icon: 'success',
                title: 'Medida creado exitosamente',
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
                title: '??Est?? seguro?',
                text: "No ser?? capaz de revertir esto!",
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
