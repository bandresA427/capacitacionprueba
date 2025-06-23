@extends('adminlte::page')
<link rel="stylesheet" href="{{ asset('../resources/css/custom.css') }}" />

@section('title', 'Editar practica')

@section('content_header')
<h1>Editar practicas</h1>
@stop

@section('content')

<div class="card">
    <div class="card-body">
        <form action='{{route("practicas.guardarpracticaeditada", $practicas->id)}}' method="post" >
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="titulo">Título:</label>
                <input type="text" class="form-control" id="titulo" name="titulo" value="{{ $practicas->titulo }}" required>
            </div>
            <div class="form-group">
                <label for="descripcion">Contenido:</label>
                <input type="text" class="form-control" id="descripcion" name="descripcion" value="{{ $practicas->descripcion}}" required>
            </div>
            <div class="form-group">
                <label for="fecha">fecha y hora</label>
                <input type="date" class="form-control" id="fecha" name="fecha" value="{{$practicas->fecha}}">
                <input type="time" class="form-control" id="hora" name="hora" value="{{$practicas->hora}}">
            </div>
            <button type="submit" class="btn-sm btn-flat btn-info" name="btn-guardarpracticaeditada" title='guardar practica editada' value="guardarpracticaeditada">Guardar</button>
        </form>
    </div>
</div>

@stop