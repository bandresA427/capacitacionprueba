@extends('adminlte::page')

@section('title', 'Registro de informacion de la practica sobre' . $operaciones->titulo)

@section('content_header')
<h1>Prácticas de Control de {{$operaciones->titulo}}</h1>
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
                        <th style="background-color: #337ab7; color: #ffffff;">Calificacion Normas de seguridad</th>
                        <th style="background-color: #337ab7; color: #ffffff;">tiempos por trama</th>
                        <th style="background-color: #337ab7; color: #ffffff;">promedio entre tramas</th>
                        <th style="background-color: #337ab7; color: #ffffff;">tiempos por undimbre</th>
                        <th style="background-color: #337ab7; color: #ffffff;">promedio entre urdimbre</th>
                        <th style="background-color: #337ab7; color: #ffffff;">uso de Herramientas</th>
                        <th style="background-color: #337ab7; color: #ffffff;">Limpieza y orden del telar</th>
                        <th style="background-color: #337ab7; color: #ffffff;">Soplado del telar</th>




                    </tr>
                </thead>
                <tbody>
                    @foreach($operacionesinformacion as $operacioninformacion)
                    <tr>
                        @if($operacioninformacion->Hidoperaciones == $operaciones->id)

                        @foreach($usuarios as $usuario)
                        @if($operacioninformacion->participante == $usuario->id)
                        <td> {{$usuario->name}}</td>
                        @endif
                        @endforeach
                        <td>{{ $operacioninformacion->calificacionNS}}</td>
                        <td> @php
                            $tiemposArray = json_decode($operacioninformacion->tiempostrama, true);
                            echo implode(',', $tiemposArray);
                            @endphp</td>
                        <td>{{ $operacioninformacion->resultadotrama}}</td>
                        <td> @php
                            $tiemposArray2 = json_decode($operacioninformacion->tiemposurdimbre, true);
                            echo implode(',', $tiemposArray2);
                            @endphp</td>
                        <td>{{ $operacioninformacion->resultadourdimbre}}</td>
                        <td>{{ $operacioninformacion->usoherramientas}}</td>
                        <td>{{$operacioninformacion->limpiezaOT}}</td>
                        <td>{{$operacioninformacion->sopladoT}}</td>

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
                    <form action="{{ route('practicas.informacion.cargaMasiva3', $operaciones->id) }}" method="POST">
                        @csrf
                        <div id="participantes">
                            <div class="row" id="participante_0">
                                <div class="col-md-2">
                                    <label for="Hidoperaciones">ID de la practica</label>
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control" id="Hidoperaciones" name="Hidoperaciones" placeholder="{{$operaciones->id}}" value="{{$operaciones->id}}">
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
                                <div class="col-md-3">
                                    <label for="calificacionNS">Calificación normas de seguridad:</label>
                                    <select class="form-control" id='calificacionNS' name='calificacionNS' required>
                                        <option value="Buena">Buena</option>
                                        <option value="Regular">Regular</option>
                                        <option value="Deficiente">Deficiente</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="usoherramientas">uso de herramientas:</label>
                                    <select class="form-control" id='usoherramientas' name='usoherramientas' required>
                                        <option value="Rapido">Rápido</option>
                                        <option value="Moderado">Moderado</option>
                                        <option value="Lento">Lento</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="limpiezaOT">Limpieza y orden en el telar:</label>
                                    <select class="form-control" id='limpiezaOT' name='limpiezaOT' required>
                                        <option value="Alto">Alto</option>
                                        <option value="Medio">Medio</option>
                                        <option value="Bajo">Bajo</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="sopladoT">Soplado del telar:</label>
                                    <select class="form-control" id='sopladoT' name='sopladoT' required>
                                        <option value="Alto">Alto</option>
                                        <option value="Medio">Medio</option>
                                        <option value="Bajo">Bajo</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="tiempos_0">Tiempos de trama</label>
                                    <div id="tiempos_0">
                                        <div class="input-group mb-2">
                                            <input type="number" name="tiempo[0][0]" class="form-control" aria-label="Tiempo 1">
                                            <button type="button" class="btn btn-outline-secondary" onclick="agregarTiempo(this)">+</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="tiempos_1">Tiempos de urdimbre</label>
                                    <div id="tiempos_1">
                                        <div class="input-group mb-2">
                                            <input type="number" name="tiempo2[0][0]" class="form-control" aria-label="Tiempo2 1">
                                            <button type="button" class="btn btn-outline-secondary" onclick="agregarTiempo2(this)">+</button>
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
            <input type="number" name="tiempo2[${participanteCount - 1}][${index}]" class="form-control" aria-label="Tiempo2 ${index + 1} ">
            <button type="button" class="btn btn-outline-secondary" onclick="agregarTiempo2(this)">+</button>
        `;
            tiemposDiv.appendChild(newTiempo);
        }

        function agregarParticipante() {
            const participantesDiv = document.getElementById('participantes');
            const nuevoParticipante = document.getElementById('participante_0').cloneNode(true);
            nuevoParticipante.id = 'participante_' + participanteCount; // Asigna el ID al contenedor
            // Actualiza los atributos de los elementos dentro del nuevo participante
            nuevoParticipante.querySelectorAll('[name^="numero_control"], [name^="participante"], [name^="tiempo"]').forEach(element => {
                element.name = element.name.replace(/\[0\]/g, `[${participanteCount}]`);
                element.id = element.id.replace(/_0/g, `_${participanteCount}`);
            });
            participantesDiv.appendChild(nuevoParticipante);
            participanteCount++;
        }

        function eliminarParticipante(button) {
            const participanteDiv = button.parentNode.parentNode;
            participanteDiv.remove();
        }
    </script>


    <!-- Modal para editar práctica -->



</div>
@endsection