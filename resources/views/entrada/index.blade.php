@extends('adminlte::page')

@section('title', 'Entradas')

@section('content_header')
<div class="row justify-content-md-center">
    <div class="col-12">
@can('entrada.create')
                                    <a href="{{ url('entrada/create') }}" type="button" class="btn btn-pastel1">  <i class="fas fa-folder-plus"></i> Registrar
                                        una nueva entrada</a>
                                    @endcan
                                    @can('entrada.import-excel')
                                    <a href="{{ url('entrada/import-excel') }}" type="button" class="btn btn-pastel2"> <i class="fas fa-file-excel"></i> Importar excel</a>
                                    @endcan   
                                    <a href="{{ url('entrada/pdf') }}" type="button" class="btn btn-pastel3"><i class="fas fa-file-pdf"></i> Imprimir </a>
                                </div>

                            </div>
                                    @stop

@section('content')

<link rel="stylesheet" href="css/pasteles.css">

<div class="row justify-content-md-center">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <table class="table" id="example">
                                    <thead class="myhead" >
                                        <tr>
                                            <th>Item</th>
                                            <th>Número de Orden</th>
                                            <th>Producto</th>
                                            <th>Cantidad</th>
                                            <th>Fecha</th>
                                            <th>Observacion</th>
                                            {{-- <th>validador</th> --}}
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($entradas as $entrada)
                                            {{-- @if ($pedido->semana_id == $sema->semana_id){ --}}
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
                                                    <form action="{{ url('/entrada/' . $entrada->id) }}" id="form-eliminar"  class="d-inline"
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
                            <!-- /.card-body -->
                            {{-- <div class="card-footer clearfix">
                                <ul class="pagination pagination-sm m-0 float-right">
                                    <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                                    {!! $entradas->links() !!}
                                    <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                                </ul>
                            </div> --}}
                        </div>
                    </div>
                </div>
@stop
@section('js')

{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"
>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.bootstrap4.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.colVis.min.js"></script> --}}
<script >
    $(document).ready(function() {
  var table = $('#example').DataTable( {
      lengthChange: false,
      buttons: [
          {
              extend: 'csv',
              split: [ 'pdf', 'excel'],
          },
          'colvis'
      ]
  } );

  table.buttons().container()
      .appendTo( '#example_wrapper .col-md-6:eq(0)' );
} );
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
