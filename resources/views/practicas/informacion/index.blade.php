@extends('adminlte::page')

@section('title', 'Registro de informacion de la practica sobre' . $practicas->titulo)

@section('content_header')
<h1>Prácticas de Control de {{$practicas->titulo}}</h1>
@endsection


@section('content')
<div class="container">
    <a href="#" data-toggle="modal" data-target="#crearPracticaModal" class="btn btn-md btn-success"><i class="fas fa-plus"></i> Crear Prática</a>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>

                        <th style="background-color: #337ab7; color: #ffffff;">Participante</th>
                        <th style="background-color: #337ab7; color: #ffffff;">Resultados</th>
                        <th style="background-color: #337ab7; color: #ffffff;">Tiempos (en Seg.)</th>


                    </tr>
                </thead>
                <tbody>
                    @foreach($practicasinformacion as $practicainformacion)
                    <tr>
                        @if($practicainformacion->Hidpractica == $practicas->id)

                        @foreach($usuarios as $usuario)
                        @if($practicainformacion->participante == $usuario->id)
                        <td> {{$usuario->name}}</td>
                        @endif
                        @endforeach
                        <td>{{ $practicainformacion->resultado }} segundos</td>
                        <td> @php
                            $tiemposArray = json_decode($practicainformacion->tiempos, true);
                            echo implode(',', $tiemposArray);
                            @endphp</td>

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
                    <form action="{{ route('practicas.informacion.cargaMasiva', $practicas->id) }}" method="POST">
                        @csrf
                        <div id="participantes">
                            <div class="row" id="participante_0">
                                <div class="col-md-2">
                                    <label for="Hidpractica">ID de la practica</label>
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control" id="Hidpractica" name="Hidpractica" placeholder="{{$practicas->id}}" value="{{$practicas->id}}">
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
                                <div class="col-md-5">
                                    <label for="tiempos_0">Tiempos</label>
                                    <div id="tiempos_0">
                                        <div class="input-group mb-2">
                                            <input type="number" name="tiempo[0][0]" class="form-control" aria-label="Tiempo 1">
                                            <button type="button" class="btn btn-outline-secondary" onclick="agregarTiempo(this)">+</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-danger" onclick="eliminarParticipante(this)">-</button>
                                </div>
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