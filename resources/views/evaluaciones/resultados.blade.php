@extends('adminlte::page')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-SZXxv2zXqlJMvvjhZrG0JxZjrWSe8OQGq5GJ19s968JWtmI0f6pqW8LKC3WT24E" crossorigin="anonymous">
@section('css')
<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    h1,
    h2 {
        font-family: 'Roboto', sans-serif;
        font-weight: bold;
        color: #333;
    }

    .container-fluid {
        padding: 30px;
    }

    .table-responsive {
        overflow-x: auto;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">Resultados de la evaluación</h1>
            @if(count($resultados) >= 0)
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                <thead>
                            <tr>
                                <th>Pregunta</th>
                                <th>Correcta/Incorrecta</th>
                            </tr>
                        </thead>
                        <tbody>
                     
                            @foreach ($resultados as $respuesta)
                                <tr>
                                    <td>{{ $respuesta->pregunta_id }}</td>
                                    
                                    <td>
                                        @if ($respuesta->correcta == 0)
                                            Respuesta incorrecta  <i class="fas fa-times text-danger"></i>
                                        @else
                                            Respuesta correcta  <i class="fas fa-check text-success"></i>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>

            <h2 class="text-center">La nota máxima alcanzada por el participante en todos los intentos de esta evaluación es de: {{$puntaje*2}} puntos</h2>
            @else
            <h2 class="text-center">No hay respuestas dadas por usted para esta evaluación por los momentos</h2>
            @endif
        </div>
    </div>
</div>
@endsection