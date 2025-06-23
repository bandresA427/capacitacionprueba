@extends('adminlte::page')
<link rel="stylesheet" href="{{ asset('../resources/css/custom.css') }}"/>

@section('title', 'Reporte de usuarios culminados')

@section('content_header')
    <h1>Reporte de usuarios culminados</h1>
@endsection

@section('content')
<a href="{{ route('reportes.index') }}" class="btn btn-sm btn-info"><i class="fas fa-arrow-left"></i> Volver</a>
    <a href="{{ route('generar-reporte-culminados') }}" class="btn btn-sm btn-info">Generar PDF</a>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Usuarios culminados</h3>
                </div>
                <div class="card-body">
                    <p>Cantidad de usuarios que han culminado el curso de capacitación: {{ $usuariosCulminados[0]->usuarios_culminados }}</p>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nombre y Apellido</th>
                                <th>Cédula de Identidad</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usuariosCompletosId as $usuariosId)
                                <tr>
                                    <td>{{ $usuariosId->name }}</td>
                                    <td>{{ $usuariosId->cedula }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
