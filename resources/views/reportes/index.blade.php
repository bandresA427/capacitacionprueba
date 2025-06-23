@extends('adminlte::page')

@section('title', 'Módulos de Reportes')

@section('content_header')
<h1 style=" font-size: 24px; font-weight: bold; margin-top: 20px; margin-bottom: 20px;">Módulos de Reportes</h1>
@stop

@section('content')

@if(Auth::user()->usertype=='admin' )
<div class="row">
    <div class="col-12">
        <div class="card mb-3" style="border-radius: 20px;">
            <div class="card-body">
                <h5 class="card-title" style="text-align: center; font-size: 20px; font-weight: bold; margin-top: 20px; margin-bottom: 10px;">Reportes de Usuarios</h5>
                <a href="{{ route('reporte-usuarios') }}" class="btn btn-primary btn-lg float-right" style="border-radius: 20px; font-size: 18px; font-weight: bold; width: 120px; height: 40px; padding: 10px; margin-top: 10px; background-color:#0e4a80;">
                    <i class="fas fa-eye"></i> Ver
                </a>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card mb-3" style="border-radius: 20px;">
            <div class="card-body">
                <h5 class="card-title" style="text-align: center; font-size: 20px; font-weight: bold; margin-top: 20px; margin-bottom: 10px;">Reportes de Evaluaciones</h5>
                <a href="{{ route('reporte-evaluaciones') }}" class="btn btn-primary btn-lg float-right" style="border-radius: 20px; font-size: 18px; font-weight: bold; width: 120px; height: 40px; padding: 10px; margin-top: 10px;background-color:#0e4a80;">
                    <i class="fas fa-eye"></i> Ver
                </a>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card mb-3" style="border-radius: 20px;">
            <div class="card-body">
                <h5 class="card-title" style="font-size: 20px; font-weight: bold; display: grid; justify-content: center; align-items: center; height: 40px;">Reportes de Culminados</h5>
                <a href="{{ route('reporte-culminados') }}" class="btn btn-primary btn-lg float-right" style="border-radius: 20px; font-size: 18px; font-weight: bold; width: 120px; height: 40px; padding: 10px; margin-top: 10px; background-color:#0e4a80;">
                    <i class="fas fa-eye"></i> Ver
                </a>
            </div>
        </div>
    </div>
   <!-- <div class="col-12">
        <div class="card mb-3" style="border-radius: 20px;">
            <div class="card-body">
                <h5 class="card-title" style="text-align: center; font-size: 20px; font-weight: bold; margin-top: 20px; margin-bottom: 10px;">Reportes en PDF</h5>
                <a href="{{ route('generar-reporte') }}" class="btn btn-primary btn-lg float-right" style="border-radius: 10px; font-size: 18px; font-weight: bold; width: 120px; height: 40px; ">
                    <i class="fas fa-file-pdf"></i> Generar
                </a>
            </div>
        </div>
    </div>
</div>-->

@endif

@stop