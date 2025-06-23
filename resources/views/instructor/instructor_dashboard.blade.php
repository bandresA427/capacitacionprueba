@extends('adminlte::page')
<link rel="stylesheet" href="{{ asset('../resources/css/custom.css') }}"/>

@section('title', 'Pagina Principal')

@section('content_header')
    <h1>Panel supervisor</h1>
@stop

@section('content')
<img src="fondo2.png" alt="" height="40%" width="90%"></img>
<div class="row">
    <div class="col-lg-4 col-6">
        <div class="card card-outline-primary shadow-lg ml-2 mt-2 card-md" style="border-radius: 20px; ">
            <div class="card-header" style="background-image: url('jeanlightblue.jpg'); color:white;">


                <h2> Evaluaciones<i class="fas fa-check" style="float: right; height: 120px;"></i> </h2>
            </div>
            <div class="card-body" style="height: 100px;">
                <p>Dentro de este modulo se puede realizar las distintas evaluaciones para los usuarios</p>
            </div>
            <a href="{{ url('/evaluaciones') }}"  class="btn btn-sm btn-primary" style="background-color:#0e4a80; font-size: 20px;">Ingresar  </a>

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
            <a href="{{ url('/capacitacion/modulos') }}"  class="btn btn-sm btn-primary" style="background-color:#0e4a80; font-size: 20px;">Ingresar  </a>

        </div> 
    </div>

</div>
@stop


