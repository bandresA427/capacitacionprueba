@extends('adminlte::page')
<link rel="stylesheet" href="{{ asset('../resources/css/custom.css') }}"/>

@section('title', 'Reporte de evaluaciones')

@section('content_header')
    <h1>Reporte de evaluaciones</h1>
@endsection

@section('content')
<a href="{{ route('reportes.index') }}" class="btn btn-sm btn-info"><i class="fas fa-arrow-left"></i> Volver</a>
    <a href="{{ route('generar-reporte-evaluaciones') }}" class="btn btn-sm btn-info">Generar PDF</a>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Evaluaciones por usuario</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Usuario</th>
                                <th>Módulo Actual</th>
                                <th>Cantidad de evaluaciones Completadas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($evaluacionesPorUsuario as $evaluacion)
                                <tr>
                                    <td>{{ $evaluacion->name }}</td>
                                    <td>{{$evaluacion->nivel}}</td>
                                    <td>{{ $evaluacion->nivel-1 }}</td>
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
