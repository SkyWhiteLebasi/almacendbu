@extends('adminlte::page')

@section('title', 'Crear Pedido')

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
                    <form action="{{ route('pedido.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="producto_id"> Nombre Producto y su Stock</label>
                            <select class="form-control" name='producto_id' id="producto_id">
                                @foreach ($produc as $pro)
                                    <option value="{{ $pro->id }}">{{ $pro->nombre_pr }} || {{ $pro->stock }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="medida_id">Unidad de Medida</label>
                            <select class="form-control" name='medida_id' id="medida_id">
                                @foreach ($med as $me)
                                    <option value="{{ $me->id }}">{{ $me->nombre_medida }} </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="semana_id">Semana</label>
                            <select class="form-control" name='semana_id' id="semana_id">
                                @foreach ($semana as $sema)
                                    <option value="{{ $sema->id }}">{{ $sema->nombre_semana }} </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="primera_entrega"> Primera entrega</label>
                            <input type="integer" class="form-control" name="primera_entrega"
                                value="{{ isset($pedido->primera_entrega) ? $pedido->primera_entrega : old('primera_entrega') }}"
                                placeholder="primera_entrega" id="primera_entrega">
                        </div>

                        <div class="form-group">
                            <label for="segunda_entrega"> Segunda entrega</label>
                            <input type="integer" class="form-control" name="segunda_entrega"
                                value="{{ isset($pedido->segunda_entrega) ? $pedido->segunda_entrega : old('segunda_entrega') }}"
                                placeholder="segunda_entrega" id="segunda_entrega">
                        </div>

                        <div class="form-group">
                            <label for="total_entrega"> Total entrega</label>
                            <input type="integer" class="form-control" name="total_entrega"
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
