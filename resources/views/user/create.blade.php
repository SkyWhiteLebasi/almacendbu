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
                <form action="{{ route('user.store') }}" method="POST" id="signup-form" class="signup-form">
                    @csrf
                    
                    <div class="form-group">
                        <label for="nombre"> Nombre del usuario</label>
                        <input type="text" class="form-control" name="name" placeholder="ingrese nombre del usuario">
                    </div>
                    <div class="form-group">
                        <label for="nombre"> Email</label>
                        <input type="text" class="form-control" name="email" placeholder="ingrese su email"
                            id="email">
                    </div>
                    <div class="form-group">
                        <label for="nombre"> Contraseña</label>
                        <input type="password" class="form-control" name="password" placeholder="ingrese su contraseña"
                            id="password">
                        <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                    </div>
                   
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-pastel2">Guardar</button>
                        <a href="{{ url('user/') }}" class="btn btn-pastel1"> Regresar </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@stop
