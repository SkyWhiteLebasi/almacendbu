@extends('adminlte::page')

@section('title', 'Importar Salidas diarias')

@section('content_header')
@stop

@section('content')
    <link rel="stylesheet" href="../css/pasteles.css">
    @if (count($errors) > 0)
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row ">
        <div class="col-md-6 offset-md-3 mt-5">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('salida.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="foto"> Formato Excel </label>

                            <input type="file" class="form-control" name="import_file">
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-pastel2">Importar</button>
                            <a href="{{ url('salida/') }}" class="btn btn-pastel1"> Regresar </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
