@extends('adminlte::page')

@section('title', 'Registro de informacion de la practica sobre' . $calidad->titulo)

@section('content_header')
<h1>Prácticas de Control de {{$calidad->titulo}}</h1>
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
                        <th style="background-color: #337ab7; color: #ffffff;">identificar defectos</th>
                        <th style="background-color: #337ab7; color: #ffffff;">identificar Correctivos</th>
                        <th style="background-color: #337ab7; color: #ffffff;">accion correctiva en el telar</th>
                        <th style="background-color: #337ab7; color: #ffffff;">ponderacion</th>




                    </tr>
                </thead>
                <tbody>
                    @foreach($calidadinformacion as $calidadesinformacion)
                    <tr>
                        @if($calidadesinformacion->Hidcalidad == $calidad->id)

                        @foreach($usuarios as $usuario)
                        @if($calidadesinformacion->participante == $usuario->id)
                        <td> {{$usuario->name}}</td>
                        @endif
                        @endforeach
                        <td>{{ $calidadesinformacion->identificarD }}</td>
                        <td>{{ $calidadesinformacion->identificarC }}</td>
                        <td> @php
                            $correctivas = json_decode($calidadesinformacion->correctiva, true);
                            echo implode(',', $correctivas);
                            @endphp</td>
                        <td>{{ $calidadesinformacion->resultado}}</td>

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
                    <form action="{{ route('practicas.informacion.cargaMasiva4', $calidad->id) }}" method="POST">
                        @csrf
                        <div id="participantes">
                            <div class="row" id="participante_0">
                                <div class="col-md-2">
                                    <label for="Hidcalidad">ID de la practica</label>
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control" id="Hidcalidad" name="Hidcalidad" placeholder="{{$calidad->id}}" value="{{$calidad->id}}">
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
                                    <label for="identificarD">Identificar defectos:</label>
                                    <select class="form-control" id='identificarD' name='identificarD' required>
                                        <option value="Muy Buena"> Muy Buena</option>
                                        <option value="Buena">Buena</option>
                                        <option value="Mala">Mala</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="identificarC">Identificar Correctivos:</label>
                                    <select class="form-control" id='identificarC' name='identificarC' required>
                                        <option value="Alto">Alto</option>
                                        <option value="Medio">Medio</option>
                                        <option value="bajo">bajo</option>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <label for="correctiva">Accion correctiva en el telar</label>
                                    <div id="correctiva">
                                        
                                            <label for="correctiva[0][0]"> defecto 1</label><br>
                                        <select class="form-control" id='correctiva[0][0]' name='correctiva[0][0]' >
                                                <option value="1">Buena</option>
                                                <option value="0">Deficiente</option>
                                            </select>
                                            
                                            <label for="correctiva[0][1]"> defecto 2</label><br>
                                        <select class="form-control" id='correctiva[0][1]' name='correctiva[0][1]' >
                                                <option value="1">Buena</option>
                                                <option value="0">Deficiente</option>
                                            </select>
                                            
                                            <label for="correctiva[0][2]"> defecto 3</label><br>
                                        <select class="form-control" id='correctiva[0][2]' name='correctiva[0][2]' >
                                                <option value="1">Buena</option>
                                                <option value="0">Deficiente</option>
                                            </select>
                                            
                                            <label for="correctiva[0][3]"> defecto 4</label><br>
                                        <select class="form-control" id='correctiva[0][3]' name='correctiva[0][3]' >
                                                <option value="1">Buena</option>
                                                <option value="0">Deficiente</option>
                                            </select>
                                            
                                        
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

        function agregardefecto(button) {
            const tiemposDiv = button.parentNode.parentNode;
            const index = tiemposDiv.querySelectorAll('input[name^="correctiva"]').length;
            const newTiempo = document.createElement('div');
            newTiempo.classList.add('input-group', 'mb-2');
            newTiempo.innerHTML = `
            <select class="form-control" id='correctiva[${participanteCount - 1}][${index}]' name='correctiva[0][${index}]'>
             <option value="1">Buena</option>
             <option value="0">Deficiente</option>
            </select>
            <button type="button" class="btn btn-outline-secondary" onclick="agregardefecto(this)">+</button>
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