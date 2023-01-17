@extends('adminlte::page')

@section('title', 'Asignar rol')

@section('content_header')
@stop

@section('content')
    <link rel="stylesheet" href="../../css/pasteles.css">
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
                    {!! Form::model($user, ['route' => ['user.update', $user], 'method' => 'put']) !!}
                    @foreach ($roles as $rol)
                        <div>
                            <label>
                                {!! Form::checkbox('roles[]', $rol->id, null, ['class' => 'mr-1']) !!}
                                {{ $rol->name }}
                            </label>
                        </div>
                    @endforeach
                    {!! Form::submit('Asignar rol', ['class' => 'btn btn-pastel1']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop
