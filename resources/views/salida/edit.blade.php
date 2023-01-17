@extends('adminlte::page')

@section('title', 'Editar Salida')

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

                    <form action="{{ url('/salida/' . $salida->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PATCH') }}
                        <div class="form-group">
                            <label for="producto_id"> Nombre Producto</label>
                            <select class="form-control" name='producto_id' id="producto_id">

                                @foreach ($produc as $pro)
                                    <option value="{{ $pro->id }}"
                                        {{ old('producto_id', $salida->producto_id) == $pro->id ? 'selected' : '' }}>
                                        {{ $pro->nombre_pr }}</option>
                                @endforeach
                            </select>
                        </div>

                        @php($variable)

                        <div class="form-group">
                            <label for="cant_salida"> Cantidad de salida</label>
                            <input type="integer" class="form-control" name="cant_salida"
                                value="{{ isset($salida->cant_salida) ? $salida->cant_salida : old('cant_salida') }}"
                                placeholder="Escriba la cantidad de salida" id="cant_salida">
                        </div>

                        {{-- <div class="form-group">
                <label for="cant_entrada"> Cantidad de entrada a modificar</label>
                <input type="integer" class="form-control" name="cant_entrada" value=""
                    placeholder="Escriba la cantidad de entrada" id="cant_entrada">
            </div> --}}

                        <div class="form-group">
                            <label for="obs_salida">Observacion de la salida</label>
                            <input type="text" class="form-control" name="obs_salida"
                                value="{{ isset($salida->obs_salida) ? $salida->obs_salida : old('obs_salida') }}"
                                placeholder="Observacion de la entrada" id="obs_salida">
                        </div>

                        <div class="form-group">
                            <label for="fecha_salida"> Fecha de entrada</label>
                            <input type="date" class="form-control" name="fecha_salida"
                                value="{{ isset($salida->fecha_salida) ? $salida->fecha_salida : old('fecha_salida') }}"
                                placeholder="fecha_salida" id="fecha_salida">
                        </div>
                        {{-- <div class="form-group">
                <label for="contador_entrada"> contador de entrada</label>
                <input type="integer" class="form-control" name="contador_entrada"
                    value="{{ isset($salida->contador_entrada) ? $salida->contador_entrada : old('contador_entrada') }}"
                    placeholder="contador_entrada" id="contador_entrada">
            </div> --}}

                        <div class="form-group">
                            <label for="contador_salida"> VALIDACION</label>
                            <select class="form-control" name='contador_salida' id="contador_salida">

                                <option value=0>validar</option>
                                <option value=1>validado</option>

                            </select>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-pastel2">Guardar</button>
                            <a href="{{ url('salida/nutricion') }}" class="btn btn-pastel1"> Regresar </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
