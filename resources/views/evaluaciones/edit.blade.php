@extends('adminlte::page')
<link rel="stylesheet" href="{{ asset('../resources/css/custom.css') }}"/>

@section('title', 'Editar evaluación')

@section('content_header')
<h1>Editar Evaluación</h1>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Formulario de edición de evaluación</h3>
    </div>
    <div class="card-body">
    
        <form action="{{ route('evaluaciones.update', $evaluacion->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="titulo">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Ingrese el título de la evaluación" value="{{ $evaluacion->titulo }}" disabled>
            </div>
           
            <div class="form-group">
                <label for="nivel">Módulo</label>
                <select class="form-control" id='nivel' name='nivel' value="{{ $evaluacion->nivel }}" disabled>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </select>
            </div>
            <div class="form-group" id="preguntas">
                @for($i = 1; $i <= 15; $i++) <div class="card" id="pregunta-template">
                    <div class="card-header">
                        <strong>Pregunta {{ $i }}</strong>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="pregunta-{{ $i }}">Pregunta</label>
                            <input type="text" class="form-control" id="pregunta-{{ $i }}" name="preguntas[{{ $i }}][pregunta]" placeholder="Ingrese la pregunta" >
                        </div>
                        <div class="form-group">
                            <label for="tipo-{{ $i }}">Tipo de Pregunta</label>
                            <select class="form-control" id="tipo-{{ $i }}" name="preguntas[{{ $i }}][tipo]">
                                <option value="seleccione">Seleccione</option>
                                <option value="respuesta_corta">Respuesta Corta</option>
                                <option value="seleccion_simple">Selección Simple</option>
                                <option value="seleccion_multiple">Selección Multiple</option>
                            </select>
                        </div>
                        <div id="respuesta_corta-{{ $i }}" style="display: none;">
                            <div class="form-group">
                                <label for="respuesta_correcta-r-{{ $i }}">Respuesta Correcta</label>
                                <input type="text" class="form-control" id="respuesta_correcta-r-{{ $i }}" name="preguntas[{{ $i }}][respuesta_correcta-r]" placeholder="Ingrese la respuesta correcta">
                            </div>
                        </div>
                        <div id="seleccion_simple-{{ $i }}" style="display: none;">
                            <div class="form-group">
                                <label for="respuesta_correcta-{{ $i }}">Respuesta Correcta</label>
                                <select class="form-control" id="respuesta_correcta-{{ $i }}" name="preguntas[{{ $i }}][respuesta_correcta]">
                                    <option value="0">Opción 1</option>
                                    <option value="1">Opción 2</option>
                                    <option value="2">Opción 3</option>
                                    <option value="3">Opción 4</option>
                                </select>
                            </div>

                            @for($j = 0; $j < 4; $j++) <div class="form-group">
                                <label for="opcion{{ $j + 1 }}-{{ $i }}"> Respuesta Opción {{ $j + 1 }}</label>
                                <input type="text" class="form-control" id="opcion{{ $j + 1 }}-{{ $i }}" name="preguntas[{{ $i }}][opciones][{{ $j }}]" placeholder="Ingrese la opción {{ $j + 1 }}">
                        </div>
                        @endfor

                    </div>
                    <div id="seleccion_multiple-{{ $i }}" style="display: none;">
                        <div class="form-group">
                            <label for="respuestas_correctas-{{ $i }}">Respuestas Correctas</label>
                            <select class="form-control" id="respuestas_correctas-{{ $i }}" name="preguntas[{{ $i }}][respuestas_correctas][]" multiple>
                                <option value="0">Opción 1</option>
                                <option value="1">Opción 2</option>
                                <option value="2">Opción 3</option>
                                <option value="3">Opción 4</option>
                            </select>
                        </div>
                        @for($j = 0; $j < 4; $j++) <div class="form-group">
                            <label for="opcion{{ $j + 1 }}-{{ $i }}"> Respuesta Opción {{ $j + 1 }}</label>
                            <input type="text" class="form-control" id="opcion{{ $j + 1 }}-{{ $i }}" name="preguntas[{{ $i }}][opciones-m][{{ $j }}]" placeholder="Ingrese la opción {{ $j + 1 }}">
                    </div>
                    @endfor
            </div>


    </div>
</div>
@endfor
</div>

</div>

<button type="submit" class="btn btn-primary" name="btn-CrearEvaluacion" value="CrearEvaluacion">Guardar Evaluación</button>
</form>
</div>
</div>
@endsection
@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#tipo-1').change(function() {
            if ($(this).val() === 'respuesta_corta') {
                $('#respuesta_corta-1').show();
                $('#seleccion_simple-1').hide();
                $('#seleccion_multiple-1').hide();
            } else if ($(this).val() === 'seleccion_simple') {
                $('#respuesta_corta-1').hide();
                $('#seleccion_simple-1').show();
                $('#seleccion_multiple-1').hide();
            } else if ($(this).val() === 'seleccion_multiple') {
                $('#respuesta_corta-1').hide();
                $('#seleccion_simple-1').hide();
                $('#seleccion_multiple-1').show();
            }
        });
        $('#tipo-2').change(function() {
            if ($(this).val() === 'respuesta_corta') {
                $('#respuesta_corta-2').show();
                $('#seleccion_simple-2').hide();
                $('#seleccion_multiple-2').hide();
            } else if ($(this).val() === 'seleccion_simple') {
                $('#respuesta_corta-2').hide();
                $('#seleccion_simple-2').show();
                $('#seleccion_multiple-2').hide();
            } else if ($(this).val() === 'seleccion_multiple') {
                $('#respuesta_corta-2').hide();
                $('#seleccion_simple-2').hide();
                $('#seleccion_multiple-2').show();
            }
        });
        $('#tipo-3').change(function() {
            if ($(this).val() === 'respuesta_corta') {
                $('#respuesta_corta-3').show();
                $('#seleccion_simple-3').hide();
                $('#seleccion_multiple-3').hide();
            } else if ($(this).val() === 'seleccion_simple') {
                $('#respuesta_corta-3').hide();
                $('#seleccion_simple-3').show();
                $('#seleccion_multiple-3').hide();
            } else if ($(this).val() === 'seleccion_multiple') {
                $('#respuesta_corta-3').hide();
                $('#seleccion_simple-3').hide();
                $('#seleccion_multiple-3').show();
            }
        });
        $('#tipo-4').change(function() {
            if ($(this).val() === 'respuesta_corta') {
                $('#respuesta_corta-4').show();
                $('#seleccion_simple-4').hide();
                $('#seleccion_multiple-4').hide();
            } else if ($(this).val() === 'seleccion_simple') {
                $('#respuesta_corta-4').hide();
                $('#seleccion_simple-4').show();
                $('#seleccion_multiple-4').hide();
            } else if ($(this).val() === 'seleccion_multiple') {
                $('#respuesta_corta-4').hide();
                $('#seleccion_simple-4').hide();
                $('#seleccion_multiple-4').show();
            }
        });
        $('#tipo-5').change(function() {
            if ($(this).val() === 'respuesta_corta') {
                $('#respuesta_corta-5').show();
                $('#seleccion_simple-5').hide();
                $('#seleccion_multiple-5').hide();
            } else if ($(this).val() === 'seleccion_simple') {
                $('#respuesta_corta-5').hide();
                $('#seleccion_simple-5').show();
                $('#seleccion_multiple-5').hide();
            } else if ($(this).val() === 'seleccion_multiple') {
                $('#respuesta_corta-5').hide();
                $('#seleccion_simple-5').hide();
                $('#seleccion_multiple-5').show();
            }
        });
        $('#tipo-6').change(function() {
            if ($(this).val() === 'respuesta_corta') {
                $('#respuesta_corta-6').show();
                $('#seleccion_simple-6').hide();
                $('#seleccion_multiple-6').hide();
            } else if ($(this).val() === 'seleccion_simple') {
                $('#respuesta_corta-6').hide();
                $('#seleccion_simple-6').show();
                $('#seleccion_multiple-6').hide();
            } else if ($(this).val() === 'seleccion_multiple') {
                $('#respuesta_corta-6').hide();
                $('#seleccion_simple-6').hide();
                $('#seleccion_multiple-6').show();
            }
        });
        $('#tipo-7').change(function() {
            if ($(this).val() === 'respuesta_corta') {
                $('#respuesta_corta-7').show();
                $('#seleccion_simple-7').hide();
                $('#seleccion_multiple-7').hide();
            } else if ($(this).val() === 'seleccion_simple') {
                $('#respuesta_corta-7').hide();
                $('#seleccion_simple-7').show();
                $('#seleccion_multiple-7').hide();
            } else if ($(this).val() === 'seleccion_multiple') {
                $('#respuesta_corta-7').hide();
                $('#seleccion_simple-7').hide();
                $('#seleccion_multiple-7').show();
            }
        });
        $('#tipo-8').change(function() {
            if ($(this).val() === 'respuesta_corta') {
                $('#respuesta_corta-8').show();
                $('#seleccion_simple-8').hide();
                $('#seleccion_multiple-8').hide();
            } else if ($(this).val() === 'seleccion_simple') {
                $('#respuesta_corta-8').hide();
                $('#seleccion_simple-8').show();
                $('#seleccion_multiple-8').hide();
            } else if ($(this).val() === 'seleccion_multiple') {
                $('#respuesta_corta-8').hide();
                $('#seleccion_simple-8').hide();
                $('#seleccion_multiple-8').show();
            }
        });
        $('#tipo-9').change(function() {
            if ($(this).val() === 'respuesta_corta') {
                $('#respuesta_corta-9').show();
                $('#seleccion_simple-9').hide();
                $('#seleccion_multiple-9').hide();
            } else if ($(this).val() === 'seleccion_simple') {
                $('#respuesta_corta-9').hide();
                $('#seleccion_simple-9').show();
                $('#seleccion_multiple-9').hide();
            } else if ($(this).val() === 'seleccion_multiple') {
                $('#respuesta_corta-9').hide();
                $('#seleccion_simple-9').hide();
                $('#seleccion_multiple-9').show();
            }
        });
        $('#tipo-10').change(function() {
            if ($(this).val() === 'respuesta_corta') {
                $('#respuesta_corta-10').show();
                $('#seleccion_simple-10').hide();
                $('#seleccion_multiple-10').hide();
            } else if ($(this).val() === 'seleccion_simple') {
                $('#respuesta_corta-10').hide();
                $('#seleccion_simple-10').show();
                $('#seleccion_multiple-10').hide();
            } else if ($(this).val() === 'seleccion_multiple') {
                $('#respuesta_corta-10').hide();
                $('#seleccion_simple-10').hide();
                $('#seleccion_multiple-10').show();
            }
        });
        $('#tipo-11').change(function() {
            if ($(this).val() === 'respuesta_corta') {
                $('#respuesta_corta-11').show();
                $('#seleccion_simple-11').hide();
                $('#seleccion_multiple-11').hide();
            } else if ($(this).val() === 'seleccion_simple') {
                $('#respuesta_corta-11').hide();
                $('#seleccion_simple-11').show();
                $('#seleccion_multiple-11').hide();
            } else if ($(this).val() === 'seleccion_multiple') {
                $('#respuesta_corta-11').hide();
                $('#seleccion_simple-11').hide();
                $('#seleccion_multiple-11').show();
            }
        });
        $('#tipo-12').change(function() {
            if ($(this).val() === 'respuesta_corta') {
                $('#respuesta_corta-12').show();
                $('#seleccion_simple-12').hide();
                $('#seleccion_multiple-12').hide();
            } else if ($(this).val() === 'seleccion_simple') {
                $('#respuesta_corta-12').hide();
                $('#seleccion_simple-12').show();
                $('#seleccion_multiple-12').hide();
            } else if ($(this).val() === 'seleccion_multiple') {
                $('#respuesta_corta-12').hide();
                $('#seleccion_simple-12').hide();
                $('#seleccion_multiple-12').show();
            }
        });
        $('#tipo-13').change(function() {
            if ($(this).val() === 'respuesta_corta') {
                $('#respuesta_corta-13').show();
                $('#seleccion_simple-13').hide();
                $('#seleccion_multiple-13').hide();
            } else if ($(this).val() === 'seleccion_simple') {
                $('#respuesta_corta-13').hide();
                $('#seleccion_simple-13').show();
                $('#seleccion_multiple-13').hide();
            } else if ($(this).val() === 'seleccion_multiple') {
                $('#respuesta_corta-13').hide();
                $('#seleccion_simple-13').hide();
                $('#seleccion_multiple-13').show();
            }
        });
        $('#tipo-14').change(function() {
            if ($(this).val() === 'respuesta_corta') {
                $('#respuesta_corta-14').show();
                $('#seleccion_simple-14').hide();
                $('#seleccion_multiple-14').hide();
            } else if ($(this).val() === 'seleccion_simple') {
                $('#respuesta_corta-14').hide();
                $('#seleccion_simple-14').show();
                $('#seleccion_multiple-14').hide();
            } else if ($(this).val() === 'seleccion_multiple') {
                $('#respuesta_corta-14').hide();
                $('#seleccion_simple-14').hide();
                $('#seleccion_multiple-14').show();
            }
        });
        $('#tipo-15').change(function() {
            if ($(this).val() === 'respuesta_corta') {
                $('#respuesta_corta-15').show();
                $('#seleccion_simple-15').hide();
                $('#seleccion_multiple-15').hide();
            } else if ($(this).val() === 'seleccion_simple') {
                $('#respuesta_corta-15').hide();
                $('#seleccion_simple-15').show();
                $('#seleccion_multiple-15').hide();
            } else if ($(this).val() === 'seleccion_multiple') {
                $('#respuesta_corta-15').hide();
                $('#seleccion_simple-15').hide();
                $('#seleccion_multiple-15').show();
            }
        });
    });
</script>
@endsection