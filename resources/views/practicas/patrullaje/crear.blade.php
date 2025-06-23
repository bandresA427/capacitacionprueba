@extends('adminlte::page')
<link rel="stylesheet" href="{{ asset('../resources/css/custom.css') }}" />

@section('title', 'Agregar practica')

@section('content_header')
<h1>Agregar practica de patrullaje</h1>
@stop

@section('content')

<div class="card">
    <div class="card-body">
        <form action="{{ route('practicas.guardarpractica2')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="titulo">Título:</label>
                <input type="text" class="form-control" id="titulo" name="titulo" value="{{ old('titulo') }}" placeholder=" Campo Requerido*" required>
            </div>
            <div class="form-group">
                <label for="observacion">Observacion:</label>
                <input type="text" class="form-control" id="observacion" name="observacion" placeholder="Campo Requerido*" required>
            </div>
            <div class="form-group">
                <label for="fecha">fecha y hora</label>
                <input type="date" class="form-control" id="fecha" name="fecha">
                <input type="time" class="form-control" id="hora" name="hora">
            </div>
            <button type="submit" class="btn-sm btn-flat btn-info" name="btn-crearpractica" title='crear practica' value="crearpractica">Guardar</button>
        </form>
    </div>
</div>

@stop