@extends('adminlte::page')

@section('title', 'Editar Entrada')

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
                    <form action="{{ url('/entrada/' . $entrada->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PATCH') }}
                        <div class="form-group">
                            <label for="producto_id"> Nombre Producto y su Stock</label>
                            <select class="form-control" name='producto_id' id="producto_id">
                                @foreach ($produc as $pro)
                                    <option value="{{ $pro->id }}"
                                        {{ old('producto_id', $entrada->producto_id) == $pro->id ? 'selected' : '' }}>
                                        {{ $pro->nombre_pr }} || {{ $pro->stock }}</option>
                                @endforeach
                            </select>
                        </div>



                        <div class="form-group">
                            <label for="cant_entrada"> Cantidad de entrada</label>
                            <input type="integer" class="form-control" name="cant_entrada"
                                value="{{ isset($entrada->cant_entrada_val) ? $entrada->cant_entrada_val : old('cant_entrada') }}"
                                placeholder="Escriba la cantidad de entrada" id="cant_entrada">
                        </div>
                        <div class="form-group">
                            {{-- <label for="cant_entrada_val"> Cantidad de entrada val</label> --}}
                            <input type="hidden" class="form-control" name="cant_entrada_val"
                                value="{{ isset($entrada->cant_entrada_val) ? $entrada->cant_entrada_val : old('cant_entrada_val') }}"
                                placeholder="Escriba la cantidad de entrada" id="cant_entrada_val">
                        </div>


                        <div class="form-group">
                            <label for="obs_entrada">Observacion de la entrada</label>
                            <input type="text" class="form-control" name="obs_entrada"
                                value="{{ isset($entrada->obs_entrada) ? $entrada->obs_entrada : old('obs_entrada') }}"
                                placeholder="Observacion de la entrada" id="obs_entrada">
                        </div>

                        <div class="form-group">
                            <label for="fecha_entrada"> Fecha de entrada</label>
                            <input type="date" class="form-control" name="fecha_entrada"
                                value="{{ isset($entrada->fecha_entrada) ? $entrada->fecha_entrada : old('fecha_entrada') }}"
                                placeholder="fecha_entrada" id="fecha_entrada">
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-pastel2">Guardar Datos</button>
                            <a href="{{ url('pedido/') }}" class="btn btn-pastel1"> Regresar </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
