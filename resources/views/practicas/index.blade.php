@extends('adminlte::page')

@section('title', 'Registro de práticas')
@section('Header')
<h1> Modulo de evaluación de prácticas de Jeantex</h1>
@endsection
@section('content')
<br>
<div class=" card " style="padding: 5%;" id="nudos">
<h2>Tiempos Promedios en Nudos</h2> <br>
<div class="container">
    <a href="{{ route('practicas.crearpractica') }}" class="btn btn-md btn-success"><i class="fas fa-plus"></i> Crear Prática</a>
    <a href="{{ route('practicas.imprimir') }}" class="btn btn-md btn-info"><i class="fas fa-print"></i> Imprimir Resultados</a><br>
    <br>
    <div class="row">
        <div class="col-md-12">

            @if( 1 < 0) <p>No se encuentran registros actualmente, por favor cargar resultados.</p>
                @else
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th style="background-color: #337ab7; color: #ffffff;">Número de Control</th>
                            <th style="background-color: #337ab7; color: #ffffff;">titulo</th>
                            <th style="background-color: #337ab7; color: #ffffff;">descripcion</th>
                            <th style="background-color: #337ab7; color: #ffffff;">fecha y hora</th>
                            <th style="background-color: #337ab7; color: #ffffff;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($practicas as $practica)
                        <tr>
                            <td>{{ $practica->id }}</td>
                            <td> {{$practica->titulo}}</td>
                            <td>{{ $practica->descripcion }}</td>
                            <td>{{$practica->fecha.' '.$practica->hora }}</td>
                            <td>
                            <form action="{{ route('practicas.eliminarpractica', $practica->id) }}" method="POST" onsubmit="return confirm('¿Está seguro de que quiere eliminar este módulo?');">
                                @csrf
                            <a href="{{ route('practicas.informacion.index', $practica->id) }}" class="btn btn-md btn-info"><i class="fas fa-eye"></i></a>
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" name="btn-Deshabilitarpractica" title='eliminar practica' value="eliminarpractica"><i class="fas fa-trash"></i></button>
                            </form>

                                <!-- <a href="#" data-toggle="modal" data-target="#editarPracticaModal{{ $practica->id }}" class="btn btn-sm btn-primary" title="Editar práctica"><i class="fas fa-edit"></i> </a>
                                <a href="#" data-toggle="modal" data-target="#eliminarPracticaModal{{ $practica->id }}" class="btn btn-sm btn-danger" title="Eliminar práctica"><i class="fas fa-trash"></i> </a> -->
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                 @endif

        </div>
        
    </div>
    
</div>
</div>
<br>
<div class=" card " style="padding: 5%;" id=patrullaje-y-operaciones>
<h2>Patrullaje y operaciones</h2> <br>
<div class="container">
    <a href="{{ route('practicas.crearpractica2') }}" class="btn btn-md btn-success"><i class="fas fa-plus"></i> Crear Prática</a>
    <a href="{{ route('practicas.imprimir') }}" class="btn btn-md btn-info"><i class="fas fa-print"></i> Imprimir Resultados</a><br>
    <br>
    <div class="row">
        <div class="col-md-12">

            @if( 1 < 0) <p>No se encuentran registros actualmente, por favor cargar resultados.</p>
                @else
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th style="background-color: #337ab7; color: #ffffff;">Número de Control</th>
                            <th style="background-color: #337ab7; color: #ffffff;">titulo</th>
                            <th style="background-color: #337ab7; color: #ffffff;">Observaciones</th>
                            <th style="background-color: #337ab7; color: #ffffff;">fecha y hora</th>
                            <th style="background-color: #337ab7; color: #ffffff;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($patrullaje as $patrullajes)
                        <tr>
                            <td>{{ $patrullajes->id }}</td>
                            <td> {{$patrullajes->titulo}}</td>
                            <td>{{ $patrullajes->observacion }}</td>
                            <td>{{$patrullajes->fecha.' '.$patrullajes->hora }}</td>
                            <td>
                            <form action="{{ route('practicas.eliminarpractica2', $patrullajes->id) }}" method="POST" onsubmit="return confirm('¿Está seguro de que quiere eliminar este módulo?');">
                                @csrf
                            <a href="{{ route('practicas.informacion.index2', $patrullajes->id) }}" class="btn btn-md btn-info"><i class="fas fa-eye"></i></a>
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" name="btn-Deshabilitarpractica" title='eliminar practica' value="eliminarpractica"><i class="fas fa-trash"></i></button>
                            </form>
                         </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                 @endif

        </div>
        
    </div>
    
</div>
</div>
<br>
<div class=" card " style="padding: 5%;" id="operacion-telar">
<h2>Operación del telar</h2> <br>
<div class="container">
    <a href="{{ route('practicas.crearpractica3') }}" class="btn btn-md btn-success"><i class="fas fa-plus"></i> Crear Prática</a>
    <a href="{{ route('practicas.imprimir') }}" class="btn btn-md btn-info"><i class="fas fa-print"></i> Imprimir Resultados</a><br>
    <br>
    <div class="row">
        <div class="col-md-12">

            @if( 1 < 0) <p>No se encuentran registros actualmente, por favor cargar resultados.</p>
                @else
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th style="background-color: #337ab7; color: #ffffff;">Número de Control</th>
                            <th style="background-color: #337ab7; color: #ffffff;">titulo</th>
                            <th style="background-color: #337ab7; color: #ffffff;">observaciones</th>
                            <th style="background-color: #337ab7; color: #ffffff;">fecha y hora</th>
                            <th style="background-color: #337ab7; color: #ffffff;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($operaciones as $operacion)
                        <tr>
                            <td>{{ $operacion->id }}</td>
                            <td> {{$operacion->titulo}}</td>
                            <td>{{ $operacion->observacion }}</td>
                            <td>{{$operacion->fecha.' '.$operacion->hora }}</td>
                            <td>
                            <form action="{{ route('practicas.eliminarpractica3', $operacion->id) }}" method="POST" onsubmit="return confirm('¿Está seguro de que quiere eliminar este módulo?');">
                                @csrf
                            <a href="{{ route('practicas.informacion.index3', $operacion->id) }}" class="btn btn-md btn-info"><i class="fas fa-eye"></i></a>
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" name="btn-Deshabilitarpractica" title='eliminar practica' value="eliminarpractica"><i class="fas fa-trash"></i></button>
                            </form>
                         </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                 @endif

        </div>
        
    </div>
    
</div>
</div>
<br>
<div class=" card " style="padding: 5%;" id="calidad-tejido">
<h2>Calidad del tejido</h2> <br>
<div class="container">
    <a href="{{ route('practicas.crearpractica4') }}" class="btn btn-md btn-success"><i class="fas fa-plus"></i> Crear Prática</a>
    <a href="{{ route('practicas.imprimir') }}" class="btn btn-md btn-info"><i class="fas fa-print"></i> Imprimir Resultados</a><br>
    <br>
    <div class="row">
        <div class="col-md-12">

            @if( 1 < 0) <p>No se encuentran registros actualmente, por favor cargar resultados.</p>
                @else
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th style="background-color: #337ab7; color: #ffffff;">Número de Control</th>
                            <th style="background-color: #337ab7; color: #ffffff;">titulo</th>
                            <th style="background-color: #337ab7; color: #ffffff;">Observaciones</th>
                            <th style="background-color: #337ab7; color: #ffffff;">fecha y hora</th>
                            <th style="background-color: #337ab7; color: #ffffff;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($calidad as $calidades)
                        <tr>
                            <td>{{ $calidades->id }}</td>
                            <td> {{$calidades->titulo}}</td>
                            <td>{{ $calidades->observacion }}</td>
                            <td>{{$calidades->fecha.' '.$calidades->hora }}</td>
                            <td>
                            <form action="{{ route('practicas.eliminarpractica4', $calidades->id) }}" method="POST" onsubmit="return confirm('¿Está seguro de que quiere eliminar este módulo?');">
                                @csrf
                                <a href="{{ route('practicas.informacion.index4', $calidades->id) }}" class="btn btn-md btn-info"><i class="fas fa-eye"></i></a>
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" name="btn-Deshabilitarpractica" title='eliminar practica' value="eliminarpractica"><i class="fas fa-trash"></i></button>
                            </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                 @endif

        </div>
        
    </div>
    
</div>
</div>
<br>
<div class=" card " style="padding: 5%;" id="comportamiento">
<h2>control de conducta laboral</h2> <br>
<div class="container">
    <a href="{{ route('practicas.crearpractica5') }}" class="btn btn-md btn-success"><i class="fas fa-plus"></i> Crear Prática</a>
    <a href="{{ route('practicas.imprimir') }}" class="btn btn-md btn-info"><i class="fas fa-print"></i> Imprimir Resultados</a><br>
    <br>
    <div class="row">
        <div class="col-md-12">

            @if( 1 < 0) <p>No se encuentran registros actualmente, por favor cargar resultados.</p>
                @else
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th style="background-color: #337ab7; color: #ffffff;">Número de Control</th>
                            <th style="background-color: #337ab7; color: #ffffff;">titulo</th>
                            <th style="background-color: #337ab7; color: #ffffff;">observaciones</th>
                            <th style="background-color: #337ab7; color: #ffffff;">fecha y hora</th>
                            <th style="background-color: #337ab7; color: #ffffff;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($comportamiento as $comportamientos)
                        <tr>
                            <td>{{ $comportamientos->id }}</td>
                            <td> {{$comportamientos->titulo}}</td>
                            <td>{{ $comportamientos->observacion }}</td>
                            <td>{{$comportamientos->fecha.' '.$comportamientos->hora }}</td>
                            <td>
                            <form action="{{ route('practicas.eliminarpractica5', $comportamientos->id) }}" method="POST" onsubmit="return confirm('¿Está seguro de que quiere eliminar este módulo?');">
                                @csrf
                                <a href="{{ route('practicas.informacion.index5', $comportamientos->id) }}" class="btn btn-md btn-info"><i class="fas fa-eye"></i></a>
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" name="btn-Deshabilitarpractica" title='eliminar practica' value="eliminarpractica"><i class="fas fa-trash"></i></button>
                            </form>

                              </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                 @endif

        </div>
        
    </div>
    
</div>
</div>
@endsection