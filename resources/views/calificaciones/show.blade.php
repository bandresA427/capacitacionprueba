@extends('adminlte::page')

@section('title', 'Revisión de Calificaciones - ' . $evaluacion->titulo)

@section('content_header')
    <h1>Revisión de Calificaciones - {{ $evaluacion->titulo }}</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Evaluación: {{ $evaluacion->titulo }}</h3>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Puntaje Más alto de la evaluación </th>
                    </tr>
                </thead>
                <tbody>
    @foreach ($respuestas as $respuesta)
        <tr>
        <td>{{ $respuesta->usuario->name ?? 'Unknown' }}</td>
            <td>{{ $mejorPuntajePorUsuario[$respuesta->usuario_id] }}</td>
            <td>
                <div class="btn-group">
                    <a href="{{ route('calificaciones.aprobarReprobar', [$evaluacion->id, $respuesta->usuario_id, 'aprobar']) }}" class="btn btn-success">Aprobar</a>
                    <a href="{{ route('calificaciones.aprobarReprobar', [$evaluacion->id, $respuesta->usuario_id, 'reprobar']) }}" class="btn btn-danger">Reprobar</a>
                </div>
            </td>
        </tr>
    @endforeach
</tbody>
</table>
        </div>
    </div>
@endsection

