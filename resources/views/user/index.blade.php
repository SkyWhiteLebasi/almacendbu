@extends('adminlte::page')

@section('title', 'Lista de Usuario')

@section('content_header')

<div class="row justify-content-md-center">
    <div class="col-8">
        <h4 style="color: #01729a"><b> Lista de Usuarios</b></h4>
    </div>
</div>
    <div class="row justify-content-md-center">
        <div class="col-8">
            <a href="{{ url('user/create') }}" class="btn btn-pastel1"> <i class="fas fa-folder-plus"></i> Registrar nuevo
                usuario</a>
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
                                    <th scope="col">Id</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Rol</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <th scope="row">{{ $num++ }} </th>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->rol }}</td>
                                        <td>
                                          <a href="{{ url('/user/'.$user->id.'/edit'),  }}" class="btn btn-pastel1"><i class="fas fa-pencil-alt"></i> Editar rol</a>
                                          |
                                         <form action="{{ url('/user/'.$user->id) }}"  class="d-inline form-eliminar" method ="POST">
                                          @csrf
                                          {{ method_field('DELETE') }}
                                          <button type="submit" class="btn btn-pastel4"><i
                                                  class="fas fa-trash-alt"></i> Borrar</button>
                                         </form>
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
                title: 'Usuario creado exitosamente',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif
    @if (session('asignar') == 'ok')
        <script>
            Swal.fire({
                // position: 'top-end',
                icon: 'success',
                title: 'Se asignó correctamente el rol',
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
