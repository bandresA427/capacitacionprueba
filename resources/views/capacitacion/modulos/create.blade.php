@extends('adminlte::page')
<link rel="stylesheet" href="{{ asset('../resources/css/custom.css') }}"/>

@section('title', 'Agregar Módulo de Capacitación')

@section('content_header')
    <h1>Agregar Módulo de Capacitación</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">
        <form action="{{ route('capacitacion.modulos.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="titulo">Título:</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" value="{{ old('titulo') }}" placeholder=" Campo Requerido*" required>
                </div>
                <div class="form-group">
                    <label for="icono">Icono(ir a https://fontawesome.com/search para referencias)</label>
                    <input type="text" class="form-control" id="icono" name="icono" >
                </div>
                <div class="form-group">
                    <label for="color">Color(colocarlos en ingles)</label>
                    <input type="text" class="form-control" id="color" name="color" >
                </div>
                <div class="form-group">
                    <label for="descripcion">Contenido:</label>
                    <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Campo Requerido*" required>
                </div>
                <div class="form-group">
                <label for="modulo">Módulo:</label>
                <select class="form-control" id='modulo' name='modulo' required>
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
                <button type="submit" class="btn-sm btn-flat btn-info" style="margin-top: 10px;" name="_submit">Guardar</button>    </div>  
@stop