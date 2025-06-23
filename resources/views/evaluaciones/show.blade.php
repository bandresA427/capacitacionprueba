@extends('adminlte::page')

<link rel="stylesheet" href="{{ asset('../resources/css/custom.css') }}"/>


@section('title', 'Evaluación')


@section('content_header')

<h1>Evaluación</h1>

@endsection


@section('content')

<div class="card">

    <div class="card-header">

        <h3 class="card-title">{{ $evaluacion->titulo }}</h3>

    </div>

    <div class="card-body">

        <div id="countdown">

            <h4>Tiempo restante: <span id="timer"></span></h4>

        </div>

        <br>

        <br>

        <form action="{{ route('evaluaciones.respuestas.store', $evaluacion) }}" method="post">

            @csrf

            @foreach (json_decode($evaluacion->preguntas, true) as $pregunta_id => $pregunta)
            <div class="card">

                <div class="card-header">

                    <h3 class="card-title">Pregunta {{ $pregunta_id +1}}</h3>

                </div>

                <div class="card-body">

                    <p>{{ $pregunta['pregunta'] }}</p>

                    <div class="form-group" id="respuesta">

                        @if ($pregunta['tipo']==='respuesta_corta' )

                        <div class="form-group">

                            <label for="respuesta{{ $pregunta_id }}">Respuesta</label>

                            <input type="text" class="form-control" id="respuesta{{ $pregunta_id }}" name="respuestas[{{ $pregunta_id }}]" placeholder="Ingrese su respuesta">

                        </div>


                        @elseif($pregunta['tipo']==='seleccion_multiple')

                        <div class="form-group">

                            <label for="respuesta{{ $pregunta_id }}">Respuesta</label>

                            <div class="custom-control custom-checkbox">

                                <input type="checkbox" class="custom-control-input" id="customCheckbox-1{{ $pregunta_id }}" name="respuestas[{{$pregunta_id}}][]" value="" selected>

                                

                            </div>

                            @foreach ($pregunta['opciones-m'] as $opcion_id => $opcion)

                            <div class="custom-control custom-checkbox">

                                <input type="checkbox" class="custom-control-input" id="customCheckbox{{ $opcion_id }}{{ $pregunta_id }}" name="respuestas[{{$pregunta_id}}][]" value="{{ $opcion_id }}">

                                <label for="customCheckbox{{ $opcion_id }}{{ $pregunta_id }}" class="custom-control-label">{{ $opcion }}</label>

                            </div>

                            @endforeach

                        </div>


                        @else

                        <div class="form-group">

                            <label for="respuesta{{ $pregunta_id }}">Respuesta</label>

                            <select class="form-control" id="respuesta{{ $pregunta_id }}" name="respuestas[{{ $pregunta_id }}]">

                                <option value="" selected>Seleccione una opción</option>

                                @foreach ($pregunta['opciones'] as $opcion_id => $opcion)

                                <option value="{{ $opcion_id }}">{{ $opcion }}</option>

                                @endforeach

                            </select>

                        </div>

                        @endif


                    </div>

                </div>

            </div>

            @endforeach
            <button type="submit" class="btn btn-primary" name="btn-TerminarEvaluacion" value="TerminarEvaluacion">terminar evaluación</button>
        </form>

    </div>


</div>

<script>
    // Establecer el tiempo inicial en segundos (60 minutos = 3600 segundos)
    var tiempoRestante = 900;

    // Función para actualizar el contador de tiempo restante
    function actualizarContador() {
        var minutos = Math.floor(tiempoRestante / 60);
        var segundos = tiempoRestante % 60;

        // Formatear los minutos y segundos con ceros a la izquierda si es necesario
        var minutosFormateados = minutos < 10 ? "0" + minutos : minutos;
        var segundosFormateados = segundos < 10 ? "0" + segundos : segundos;

        // Mostrar el tiempo restante en el elemento con el id "timer"
        document.getElementById("timer").textContent = minutosFormateados + ":" + segundosFormateados;

        // Actualizar el tiempo restante y detener la cuenta regresiva si llega a cero
        if (tiempoRestante > 0) {
            tiempoRestante--;
            setTimeout(actualizarContador, 1000); // Llamar a esta función nuevamente después de 1 segundo
        } else {
            // Redirigir a la página de inicio cuando se acabe el tiempo
            window.location.href = "{{ route('evaluaciones.index') }}";
        }
    }

    // Iniciar la cuenta regresiva al cargar la página
    window.onload = function() {
        actualizarContador();
    };
    const respuestas = {};

    // Recorre cada pregunta
    document.querySelectorAll('.pregunta').forEach((pregunta) => {
        const preguntaId = pregunta.dataset.id;
        const respuesta = pregunta.querySelector('input[type="radio"]:checked').value;

        // Agrega la respuesta al objeto JSON
        respuestas[preguntaId] = respuesta;
    });

    // Establece el valor del input oculto con el JSON de las respuestas
    document.querySelector('input[name="respuestas"]').value = JSON.stringify(respuestas);
</script>
@endsection