@extends('adminlte::page')

@section('title', 'Editar Poducto')

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

                    <form action="{{ url('/producto/' . $producto->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PATCH') }}

                        <div class="form-group">
                            <label for="num_orden"> Numero de Orden</label>
                            <input type="text" class="form-control" name="num_orden"
                                value="{{ isset($producto->num_orden) ? $producto->num_orden : old('num_orden') }}"
                                placeholder="numero de orden" id="num_orden">
                        </div>

                        <div class="form-group">
                            <label for="nombre"> Nombre Producto</label>
                            <input type="text" class="form-control" name="nombre_pr"
                                value=" {{ isset($producto->nombre_pr) ? $producto->nombre_pr : old('nombre_pr') }} "
                                id="nombre_pr">
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Unidad </label>
                            <select class="form-control" name='medida_id' id="exampleFormControlSelect1">
                                @foreach ($med as $me)
                                    <option value="{{ $me->id }}"
                                        {{ old('medida_id', $producto->medida_id) == $me->id ? 'selected' : '' }}>
                                        {{ $me->nombre_medida }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Categoria</label>
                            <select class="form-control" name='categoria_id' id="exampleFormControlSelect1">
                                @foreach ($categ as $cat)
                                    <option value="{{ $cat->id }}"
                                        {{ old('categoria_id', $producto->categoria_id) == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->nombre_categoria }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="stock"> Stock</label>
                            <input type="text" class="form-control" name="stock"
                                value="{{ isset($producto->stock) ? $producto->stock : old('stock') }}" id="stock">
                        </div>

                        <div class="form-group">
                            <label for="desc_pr"> Descripcion </label>
                            <input type="text" class="form-control"name="desc_pr"
                                value="{{ isset($producto->desc_pr) ? $producto->desc_pr : old('desc_pr') }}"
                                id="desc_pr">
                        </div>

                        {{-- <div class="form-group">
                            <label for="foto"> Foto </label>
                            @if (isset($producto->foto))
                                <img class="img-thumbnail img-fluid" src="{{ asset('storage') . '/' . $producto->foto }}"
                                    width="100px" alt="">
                            @endif
                            <input type="file" class="form-control" name="foto" value="" id="foto">
                        </div> --}}

                        <br>
                        <br>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <input type="submit" class="btn btn-pastel1" value="Guardar datos">
                            <a href="{{ url('producto/') }}" class="btn btn-pastel2"> Regresar </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
