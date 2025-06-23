@extends('adminlte::page')

@section('title', 'Registro de informacion de la practica sobre' . $comportamiento->titulo)

@section('content_header')
<h1>Prácticas de Control de {{$comportamiento->titulo}}</h1>
@endsection


@section('content')
<div class="container">
    <a href="#" data-toggle="modal" data-target="#crearPracticaModal" class="btn btn-md btn-success"><i class="fas fa-plus"></i> Crear Prática</a>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>

                        <th style="background-color: #337ab7; color: #ffffff;">Nombre/Apellido</th>
                        <th style="background-color: #337ab7; color: #ffffff;">semana 1</th>
                        <th style="background-color: #337ab7; color: #ffffff;">semana 2</th>
                        <th style="background-color: #337ab7; color: #ffffff;">semana 3</th>
                        <th style="background-color: #337ab7; color: #ffffff;">ponderacion</th>




                    </tr>
                </thead>
                <tbody>
                    @foreach($comportamientoinformacion as $comportamientosinformacion)
                    <tr>
                        @if($comportamientosinformacion->Hidcomportamiento == $comportamiento->id)

                        @foreach($usuarios as $usuario)
                        @if($comportamientosinformacion->participante == $usuario->id)
                        <td> {{$usuario->name}}</td>
                        @endif
                        @endforeach
                        <td> @php
                            $semana = json_decode($comportamientosinformacion->semana, true);
                            echo implode(',', $semana);
                            @endphp</td>
                        <td> @php
                            $semana2 = json_decode($comportamientosinformacion->semana2, true);
                            echo implode(',', $semana2);
                            @endphp</td>
                        <td> @php
                            $semana3 = json_decode($comportamientosinformacion->semana3, true);
                            echo implode(',', $semana3);
                            @endphp</td>
                        <td>@if( $comportamientosinformacion->resultado >= 15 )
                            Buena
                            @else
                            Deficiente
                            @endif
                        </td>

                        @else
                        <p>No se encontro informacion dentro de esta practica, por favor cargarla.</p>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal para crear práctica -->
    <div class="modal fade" id="crearPracticaModal" tabindex="-1" role="dialog" aria-labelledby="crearPracticaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="crearPracticaModalLabel"><i class="fas fa-plus"></i> Crear Práctica</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('practicas.informacion.cargaMasiva5', $comportamiento->id) }}" method="POST">
                        @csrf
                        <div id="participantes">
                            <div class="row" id="participante_0">
                                <div class="col-md-2">
                                    <label for="Hidcomportamiento">ID de la practica</label>
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control" id="Hidcomportamiento" name="Hidcomportamiento" placeholder="{{$comportamiento->id}}" value="{{$comportamiento->id}}">
                                    </div>

                                </div>
                                <div class="col-md-3">
                                    <label for="participante_0">Participante</label>
                                    <select name="participante[0]" id="participante_0" class="form-control">
                                        @foreach($usuarios as $usuario)
                                        <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label for="tiempos_0">semana 1 </label>
                                    <div id="tiempos_0">
                                        <div class="input-group mb-2">
                                            <input type="number" name="tiempo[0][0]" class="form-control" aria-label="Tiempo 1">
                                            <button type="button" class="btn btn-outline-secondary" onclick="agregarTiempo(this)">+</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label for="tiempos_1">semana 2 </label>
                                    <div id="tiempos_1">
                                        <div class="input-group mb-2">
                                            <input type="number" name="tiempo2[0][0]" class="form-control" aria-label="Tiempo 1">
                                            <button type="button" class="btn btn-outline-secondary" onclick="agregarTiempo2(this)">+</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label for="tiempos_2">semana 3 </label>
                                    <div id="tiempos_3">
                                        <div class="input-group mb-2">
                                            <input type="number" name="tiempo3[0][0]" class="form-control" aria-label="Tiempo 1">
                                            <button type="button" class="btn btn-outline-secondary" onclick="agregarTiempo3(this)">+</button>
                                        </div>
                                    </div>
                                </div>

                                <!-- <div class="col-md-2">
                                    <button type="button" class="btn btn-danger" onclick="eliminarParticipante(this)">-</button>
                                </div> -->
                            </div>
                        </div>

                        <!-- <button type="button" class="btn btn-primary" onclick="agregarParticipante()">Agregar Participante</button> -->
                        <button type="submit" class="btn btn-success">Cargar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        let participanteCount = 1;

        function agregarTiempo(button) {
            const tiemposDiv = button.parentNode.parentNode;
            const index = tiemposDiv.querySelectorAll('input[name^="tiempo"]').length;
            const newTiempo = document.createElement('div');
            newTiempo.classList.add('input-group', 'mb-2');
            newTiempo.innerHTML = `
            <input type="number" name="tiempo[${participanteCount - 1}][${index}]" class="form-control" aria-label="Tiempo ${index + 1}">
            <button type="button" class="btn btn-outline-secondary" onclick="agregarTiempo(this)">+</button>
        `;
            tiemposDiv.appendChild(newTiempo);
        }

        function agregarTiempo2(button) {
            const tiemposDiv = button.parentNode.parentNode;
            const index = tiemposDiv.querySelectorAll('input[name^="tiempo"]').length;
            const newTiempo = document.createElement('div');
            newTiempo.classList.add('input-group', 'mb-2');
            newTiempo.innerHTML = `
            <input type="number" name="tiempo2[${participanteCount - 1}][${index}]" class="form-control" aria-label="Tiempo ${index + 1}">
            <button type="button" class="btn btn-outline-secondary" onclick="agregarTiempo2(this)">+</button>
        `;
            tiemposDiv.appendChild(newTiempo);
        }

        function agregarTiempo3(button) {
            const tiemposDiv = button.parentNode.parentNode;
            const index = tiemposDiv.querySelectorAll('input[name^="tiempo"]').length;
            const newTiempo = document.createElement('div');
            newTiempo.classList.add('input-group', 'mb-2');
            newTiempo.innerHTML = `
            <input type="number" name="tiempo3[${participanteCount - 1}][${index}]" class="form-control" aria-label="Tiempo ${index + 1}">
            <button type="button" class="btn btn-outline-secondary" onclick="agregarTiempo3(this)">+</button>
        `;
            tiemposDiv.appendChild(newTiempo);
        }

        function eliminarParticipante(button) {
            const participanteDiv = button.parentNode.parentNode;
            participanteDiv.remove();
        }
    </script>


    <!-- Modal para editar práctica -->



</div>
@endsection