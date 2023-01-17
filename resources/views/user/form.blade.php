@extends('adminlte::page')

@section('title', 'Crear Usuario')

@section('content_header')
@stop

@section('content')
<div class="content-wrapper">
    <h1>{{$modo}} usuarios</h1>


        

<div class="form-group">
<label for="nombre"> Nombre </label>
<input type="text" class="form-control" name="name" value=" {{ isset($user->name)?$user->name:old('name') }} " id="name">

</div>

<div class="form-group">
<label for="correo"> Correo electrónico </label>
<input type="text" class="form-control"name="email" value="{{ isset($user->email)?$user->email:old('email') }}" id="email">

</div>
<div class="form-group">
<label for="status"> Status </label>
<input type="text" class="form-control" name="rol" value="{{ isset($user->rol)?$user->rol:old('rol') }}" id="rol">
</div>

<div class="form-group">
<label for="password"> Contraseña </label>
<input type="password" class="form-control" name="password" value=" {{ isset($user->password)?$user->password:old('password') }} " id="password">

</div>

<br>
<br>
<input type="submit" class="btn btn-primary" value="{{$modo}} datos">
<a href="{{ url('user/')}}" class="btn btn-success"> Regresar </a>


</div>
@stop

