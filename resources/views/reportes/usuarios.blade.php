@extends('adminlte::page')
<link rel="stylesheet" href="{{ asset('../resources/css/custom.css') }}"/>

@section('title', 'Reporte de usuarios por nivel')

@section('content_header')
    <h1>Reporte de usuarios por módulo</h1>
@endsection

@section('content')
<a href="{{ route('reportes.index') }}" class="btn btn-sm btn-info"><i class="fas fa-arrow-left"></i> Volver</a>
    <a href="{{ route('generar-reporte-usuarios') }}" class="btn btn-sm btn-info">Generar PDF</a>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Participantes por Módulo</h3>
                </div>
                <div class="card-body">
                <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Módulo</th>
                                <th>Cantidad de participantes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usuariosPorNivel as $nivel)
                                <tr>
                                    <td>{{ $nivel->nivel }}</td>
                                    <td>{{ $nivel->usuarios_por_nivel }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <br><br>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Módulo</th>
                                <th>Participantes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usuariosPorNivel2 as $nivel)
                                <tr>
                                    <td>{{ $nivel->nivel }}</td>
                                    <td>{{ $nivel->name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
