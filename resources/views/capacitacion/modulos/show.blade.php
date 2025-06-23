@extends('adminlte::page')
<link rel="stylesheet" href="{{ asset('../resources/css/custom.css') }}"/>

@section('title', $modulo->titulo)

@section('content_header')
    <h1>{{ $modulo->titulo }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <p>{{ $modulo->descripcion }}</p>
            <a href="{{ route('capacitacion.modulos.index') }}" class="btn btn-sm btn-primary"><i class="fas fa-arrow"></i>volver</a>
            @if(Auth::user()->usertype == 'admin')
<a href="{{ route('capacitacion.modulos.articulos.create', $modulo) }}" class="btn btn-sm btn-primary">Agregar Artículo</a>
           
@endif
             <hr>
            @foreach ($modulo->articulos as $articulo)
                <div class="card">
                    <div class="card-header">
                        {{ $articulo->titulo }}
                    </div>
                    <div class="card-body">
                        <p>{{ $articulo->informacion }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@stop
