@extends('adminlte::page')

@section('title', 'Evaluaciones')

@section('content')

<div class="card">
    @if(session()->has('message'))
        @if(strpos(session()->get('message'), 'Felicidades') !== false)
            <div class="alert alert-success">
                {{ session()->get('message') }}
                <p>Aciertos: {{ session()->get('aciertos') }}</p>
                <p>Incorrectos: {{ session()->get('incorrectos') }}</p>
                <p>Puntaje: {{ session()->get('puntaje') }} PUNTOS</p>
            </div>
        @else
            <div class="alert alert-warning">
                {{ session()->get('message') }}
                <p>Aciertos: {{ session()->get('aciertos') }}</p>
                <p>Incorrectos: {{ session()->get('incorrectos') }}</p>
                <p>Puntaje: {{ session()->get('puntaje') }} PUNTOS</p>
            </div>
        @endif
    @endif

    @if(Auth::user()->usertype == 'admin' || Auth::user()->usertype == 'instructor')
        <a href="{{ route('evaluaciones.create') }}" class="btn btn-sm btn-info" title="Agregar Evaluación">Agregar Evaluación</a>
    @endif
    <br>

    <div class="row">
        @foreach ($evaluaciones as $evaluacion)
            @switch(true)
                @case(Auth::user()->usertype == 'user')
                    @if(Auth::user()->nivel == $evaluacion->nivel)
                        <div class="col-lg-4 col-8">
                            <div class="card card-primary card-outline-primary shadow-lg ml-2 mt-2 card-md" style="border-radius: 20px; width: 350px; height: 420px; display: flex; flex-direction: column;">
                                <div class="card-body" style="flex: 1;">
                                    <div class="card-header" style="color: rgb(0, 0, 0);">
                                        <i class="fas fa-book" style="color: rgb(8, 8, 8); font-size: 50px;"></i>
                                        <br><br>
                                        <b><h4>{{ $evaluacion->titulo }}</h4></b>
                                    </div>
                                    <div class="content" style="flex: 1; display: flex; flex-direction: column; justify-content: center;">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <a id="evaluation-button" href="{{ route('evaluaciones.show', $evaluacion) }}" class="btn custom-button" title="Comenzar Evaluación" disabled>
                                                    <i class="fas fa-play"></i> Comenzar
                                                </a>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <a href="{{ route('evaluaciones.resultados', $evaluacion->id) }}" class="btn custom-button" title="Ver resultados de la Evaluación">
                                                    <i class="fas fa-eye"></i> Resultados
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @foreach($modulos as $modulo)
                                    @if($evaluacion->nivel == $modulo->modulo)
                                        <div class="card-footer" style="background-color: {{$modulo->color}};"></div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif
                    @break
                @case(Auth::user()->usertype == 'admin' || Auth::user()->usertype == 'instructor')
                <br>
                <div class="col-lg-4 col-8">
                        <div class="card card-primary card-outline-primary shadow-lg ml-2 mt-2 card-md" style="border-radius: 20px; width: 350px; height: 420px; display: flex; flex-direction: column;">
                            <div class="card-body" style="flex: 1;">
                                <div class="card-header" style="color: black;">
                                    <i class="fas fa-book" style="color: black; font-size: 50px;"></i>
                                    <br><br>
                                    <b><h4>{{ $evaluacion->titulo }}</h4></b>
                                </div>
                                <div class="content" style="flex: 1; display: flex; flex-direction: column; justify-content: center;">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <a href="{{ route('evaluaciones.show', $evaluacion) }}" class="btn custom-button" title="Comenzar Evaluación">
                                                <i class="fas fa-play"></i> Comenzar
                                            </a>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <form action="{{ route('evaluaciones.destroy', $evaluacion->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn custom-button" title="Eliminar Evaluación" onclick="return confirm('¿Estás seguro de eliminar esta evaluación?')">
                                                    <i class="fas fa-trash-alt"></i> Eliminar evaluación
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <a href="{{ route('evaluaciones.edit', $evaluacion->id) }}" class="btn custom-button" title="editar la Evaluación">
                                                <i class="fas fa-eye"></i> editar
                                            </a>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <a href="{{ route('evaluaciones.resultados', $evaluacion->id) }}" class="btn custom-button" title="Ver resultados de la Evaluación">
                                                <i class="fas fa-eye"></i> Resultados
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @foreach($modulos as $modulo)
                                @if($evaluacion->nivel == $modulo->modulo)
                                    <div class="card-footer" style="background-color: {{$modulo->color}};"></div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    @break
            @endswitch
        @endforeach
    </div>
</div>

@endsection

<style>
    .custom-button {
        width: 100%;
        height: 35px; /* Ajusta la altura según sea necesario */
        font-size: 1rem;
        background-color: steelblue !important; /* Color azul */
        color: white !important;
        border: none;
        margin-bottom: 5px; /* Reduce el espacio entre botones */
    }
    .custom-button:hover {
        background-color: #0056b3 !important; /* Color azul más oscuro para el hover */
    }
    .card-body {
        display: flex;
        flex-direction: column;
    }
    .content {
        display: flex;
        flex-direction: column;
        justify-content: flex-end; /* Alinea los botones hacia el fondo */
    }
    .card-body .row {
        margin-bottom: 0; /* Elimina el margen inferior entre las filas */
    }
</style>
