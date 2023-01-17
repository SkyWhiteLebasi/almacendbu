@extends('adminlte::page')

@section('title', 'Editar Pedido')

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

                    <form action="{{ url('/pedido/' . $pedido->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PATCH') }}
                        <div class="form-group">
                            <label for="producto_id"> Nombre Producto</label>
                            <select class="form-control" name='producto_id' id="producto_id">

                                @foreach ($produc as $pro)
                                    <option value="{{ $pro->id }}"
                                        {{ old('producto_id', $pedido->producto_id) == $pro->id ? 'selected' : '' }}>
                                        {{ $pro->nombre_pr }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="medida_id">Unidad de Medida</label>
                            <select class="form-control" name='medida_id' id="medida_id">
                                @foreach ($med as $me)
                                    <option value="{{ $me->id }}"
                                        {{ old('medida_id', $pedido->medida_id) == $me->id ? 'selected' : '' }}>
                                        {{ $me->nombre_medida }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="primera_entrega"> Primera entrega</label>
                            <input type="text" class="form-control" name="primera_entrega"
                                value="{{ isset($pedido->primera_entrega) ? $pedido->primera_entrega : old('primera_entrega') }}"
                                placeholder="primera_entrega" id="primera_entrega">
                        </div>

                        <div class="form-group">
                            <label for="segunda_entrega"> Segunda entrega</label>
                            <input type="text" class="form-control" name="segunda_entrega"
                                value="{{ isset($pedido->segunda_entrega) ? $pedido->segunda_entrega : old('segunda_entrega') }}"
                                placeholder="segunda_entrega" id="segunda_entrega">
                        </div>

                        <div class="form-group">
                            <label for="total_entrega"> Total entrega</label>
                            <input type="text" class="form-control" name="total_entrega"
                                value="{{ isset($pedido->total_entrega) ? $pedido->total_entrega : old('total_entrega') }}"
                                placeholder="total_entrega" id="total_entrega">
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-pastel2">Guardar</button>
                            <a href="{{ url('pedido/') }}" class="btn btn-pastel1"> Regresar </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
