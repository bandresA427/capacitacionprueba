@extends('adminlte::page')
<link rel="stylesheet" href="{{ asset('../resources/css/custom.css') }}"/>

@section('title', 'Pagina Principal')
@section('content_header')
    @auth
        <h1 class="welcome-title">Bienvenido, {{ Auth::user()->name }}!</h1>
    @endauth
@stop
@section('content')
<img src="2.jpg" alt="" height="100%" width="100%"></img>
<div class="row">
    <div class="col-lg-4 col-6">
        <div class="card card-outline-primary shadow-lg ml-2 mt-2 card-md" style="border-radius: 20px; ">
            <div class="card-header" style="background-image: url('fondo.jpg'); color:white;">


                <h2> Evaluaciones<i class="fas fa-check" style="float: right; height: 120px;"></i> </h2>
            </div>
            <div class="card-body" style="height: 100px;">
                <p>Dentro de este modulo podrás realizar las evaluaciones respectivas para completar esta serie de cursos</p>
            </div>
            <a href="{{ url('/evaluations') }}" class="card-footer">Mas Informacion </i></a>
        </div>
    </div>

    <div class="col-lg-4 col-6">
        <div class="card  card-outline-primary shadow-lg ml-2 mt-2 card-md" style="border-radius: 20px; ">
            <div class="card-header " style="background-image: url('jeanlightblue.jpg'); color:white;">

                <h2 >Capacitación <i class="fas fa-book" style="float: right;height: 120px;"></i></h2>
            </div>
            <div class="card-body" style="height: 100px;">
                <p>En este módulo se puede realizar la capacitación respectiva para completar las evaluaciones </p>
            </div>
            <a href="{{ url('/capacitacion/modulos') }}" class="card-footer">Mas Información </a>
        </div> 
    </div>

</div>
@stop
