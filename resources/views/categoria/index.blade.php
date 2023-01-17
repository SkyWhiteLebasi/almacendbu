@extends('adminlte::page')

@section('title', 'Categoria')

@section('content_header')
    @can('categoria.create')
        <div class="row justify-content-md-center">
            <div class="col-8">
                <a href="{{ route('categoria.create') }}"class="btn btn-pastel1">  <i class="fas fa-folder-plus"></i> Registrar categoria</a>
            </div>

        </div>
    @endcan
@stop

@section('content')
    <link rel="stylesheet" href="css/pasteles.css">
    <div class="row justify-content-md-center">
        <div class="col-8">
            <div class="card">
                <div class="card-body">

                    <table class="table">
                        <thead class="myhead">
                            <tr>
                                <th>Item</th>
                                <th>Nombre de Categoria</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categorias as $categoria)
                                <tr>

                                    <td> {{ $num++ }} </td>
                                    <td> {{ $categoria->nombre_categoria }}</td>
                                    <td>
                                        @can('categoria.destroy')
                                            <form action="{{ url('/categoria/' . $categoria->id) }}" id="form-eliminar"
                                                class="d-inline" method="POST">
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

@stop
@section('js')
    @if (session('guardar') == 'ok')
        <script>
            Swal.fire({
                // position: 'top-end',
                icon: 'success',
                title: 'Categoria creado exitosamente',
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
@endsection
