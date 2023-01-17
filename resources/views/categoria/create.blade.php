@extends('adminlte::page')

@section('title', 'Crear Categoria')

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
                    <form action="{{ route('categoria.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="nombre_categoria"> Nombre de categoria</label>
                            <input type="text" class="form-control" name="nombre_categoria"
                                value="{{ isset($categoria->nombre_categoria) ? $categoria->nombre_categoria : old('nombre_categoria') }}"
                                placeholder="nombre de la categoria" id="nombre_categoria">
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-pastel2"> Guardar</button>
                            <a href="{{ url('categoria/') }}" class="btn btn-pastel1"> Regresar </a>

                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
