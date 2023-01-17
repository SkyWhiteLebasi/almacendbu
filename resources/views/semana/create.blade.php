@extends('adminlte::page')

@section('title', 'Crear Semana')

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
                            <form action="{{ route('semana.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="nombre"> Nombre de Semana</label>
                                    <input type="text" class="form-control" name="nombre_semana"
                                        value="{{ isset($semana->nombre_semana) ? $semana->nombre_semana : old('nombre_semana') }}"
                                        placeholder="nombre del producto" id="nombre_pr">
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button type="submit" class="btn btn-pastel2">Guardar</button>
                                    <a href="{{ url('semana/') }}" class="btn btn-pastel1"> Regresar </a>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
@stop
