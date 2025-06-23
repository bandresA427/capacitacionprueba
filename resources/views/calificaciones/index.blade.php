@extends('adminlte::page')
<link rel="stylesheet" href="{{ asset('../resources/css/custom.css') }}"/>

@section('title', 'Calificaciones de evaluaciones')

@section('content_header')
@stop

@section('content')
<div class="row">
    @foreach ( $evaluaciones as $evaluacion)
    <div class="col-lg-4 col-9">
        <div class="card card-outline-primary shadow-lg ml-2 mt-2 card-md" style="border-radius: 20px; ">
            <div class="card-header" style="background-image: url('jeanlightblue.jpg'); color:white;">


                <h1 style="height: 120px;">{{ $evaluacion->titulo }}<i class="fas fa-fw fa-user" style="float: right; "></i> </h1>
                
            </div>
            <div class="card-body" style="height: 100px;">
                <p></p>
            </div>
            <a href="{{ route('calificaciones.show', $evaluacion->id) }}"  class="btn btn-sm btn-primary">Ingresar  </a>
        </div>
    </div>
    @endforeach
</div>

@stop
