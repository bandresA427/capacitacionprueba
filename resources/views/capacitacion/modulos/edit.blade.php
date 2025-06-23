@extends('adminlte::page')
<link rel="stylesheet" href="{{ asset('../resources/css/custom.css') }}"/>

@section('content')
<div class="card">
    <h1>Editar Módulo</h1>

    <form action="{{ route('capacitacion.modulos.update', $modulo->id) }}" method="POST">
        @method('PUT')
        @csrf
        <div>
            <label for="titulo">Titulo:</label>
            <input type="text" class="form-control" name="titulo" id="titulo" value="{{ $modulo->titulo }}" required>
        </div>
        <div>
            <label for="icono">Icono:</label>
            <input type="text" class="form-control" name="icono" id="icono" value="{{ $modulo->icono }}" required>
        </div>
        <div>
            <label for="color">Color:</label>
            <input type="text" class="form-control" name="color" id="color" value="{{ $modulo->color }}" required>
        </div>
        <div>
            <label for="descripcion">Contenido</label>
            <input type="text" class="form-control" id="descripcion" name="descripcion" value="{{ $modulo->descripcion }}" required>
        </div>
        <div class="form-group">
            <label for="modulo">Módulo</label>
            <select class="form-control" id='modulo' name='modulo'>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
            </select>
        </div>
        <br>
        <button type="submit" class="btn btn-info btn-sm" name="btn-ActualizarModulo" value="ActualizarModulo">Actualizar</button>
        
    <br>
</div>
@stop