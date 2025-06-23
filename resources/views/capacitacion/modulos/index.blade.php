@extends('adminlte::page')
<link rel="stylesheet" href="{{ asset('../resources/css/custom.css') }}"/>

@section('title', 'Módulos de Capacitación')

@section('content_header')
<h1>Módulos de Capacitación</h1>
@if(Auth::user()->usertype == 'admin')
<a href="{{ route('capacitacion.modulos.create') }}" class="btn btn-md btn-info">Agregar Módulo</a>
@endif
@stop

@section('content')

<div class="row">
    @foreach ($modulos as $modulo)
        @switch(true)
                    
            @case(Auth::user()->usertype == 'user' && Auth::user()->nivel >= $modulo->modulo)
                <div class="col-lg-4 col-8">
                    <div class="card card-primary card-outline-primary shadow-lg ml-2 mt-2 card-md"
                         style="border-radius: 20px;width: 350px; height: 420px;">
                        <div class="card-body">
                            <div class="card-header" style="background-image: url('../jeanlightblue.jpg'); color:white;">
                                <i class="fas fa-{{ $modulo->icono }} " style="color: white; font-size: 50px;"></i>
                                <br><br>
                                <b><h4>{{ $modulo->titulo }}</h4></b>
                            </div>
                            <br>
                            <p id="descripcion-{{ $modulo->id }}" style="white-space: pre-wrap;"></p>

                            @csrf
                            @if (Auth::user()->nivel == $modulo->modulo)
                                <a href="{{ route('capacitacion.modulos.articulos.index', $modulo) }}"
                                   id="ver-articulo-{{ $modulo->id }}"
                                   class="btn btn-info btn-sm">Comenzar</a>
                              
                            @else
                                <p style="color: green;">Módulo Completado <i class='fas fa-check'></i></p>
                                <a href="{{ route('capacitacion.modulos.articulos.index', $modulo) }}"
                                   id="ver-articulo-{{ $modulo->id }}"
                                   class="btn btn-info btn-sm">Ingresar</a>
                            @endif
                        </div>
                        <div class="card-footer" style="background-color: {{$modulo->color}};"></div>
                    </div>
                </div>
                @break
            @case(Auth::user()->usertype == 'user' && Auth::user()->nivel < $modulo->modulo)
                <div class="col-lg-4 col-8">
                    <div class="card card-primary card-outline-primary shadow-lg ml-2 mt-2 card-md"
                         style="border-radius: 20px;width: 350px; height: 420px;">
                        <div class="card-body">
                            <div class="card-header" style="background-image: url('../jeanlightblue.jpg'); color:white;">
                                <i class="fas fa-{{ $modulo->icono }} " style="color: white; font-size: 50px;"></i>
                                <br><br>
                                <b><h4>{{ $modulo->titulo }}</h4></b>
                            </div>
                            <br>
                            <p id="descripcion-{{ $modulo->id }}" style="white-space: pre-wrap;"></p>

                            @csrf
                        </div>
                        <div class="card-footer" style="background-color: {{$modulo->color}};"></div>
                    </div>
                </div>
                @break
            @case(Auth::user()->usertype =='admin' ||Auth::user()->usertype =='instructor' )
                <div class="col-lg-4 col-8">
                    <div class="card card-primary card-outline-primary shadow-lg ml-2 mt-2 card-md"
                         style="border-radius: 20px;width: 350px; height: 420px;">
                        <div class="card-body">
                            <div class="card-header" style="background-image: url('../jeanlightblue.jpg'); color:white;">
                                <i class="fas fa-{{ $modulo->icono }} " style="color: white; font-size: 50px;"></i>
                                <br><br>
                                <b><h4>{{ $modulo->titulo }}</h4></b>
                            </div>
                            <br>
                            <p id="descripcion-{{ $modulo->id }}" style="white-space: pre-wrap;"></p>

                            <form action="{{ route('capacitacion.modulos.destroy', $modulo->id) }}" method="POST" onsubmit="return confirm('¿Está seguro de que quiere eliminar este módulo?');">
                                @csrf

                                <a href="{{ route('capacitacion.modulos.articulos.index', $modulo) }}" title='Ingresar en módulo'
                                   class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>

                                <a class="btn btn-info btn-sm" title='Editar módulo' href="{{ route('capacitacion.modulos.edit', $modulo->id) }}"><i class="fas fa-list-alt"></i></a>
                                @method('DELETE')
                                <button type="submit" class="btn btn-info btn-sm" name="btn-DeshabilitarModulo" title='Deshabilitar módulo' value="DeshabilitarModulo"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                        <div class="card-footer" style="background-color: {{$modulo->color}};"></div>
                    </div>
                </div>
                @break
        @endswitch
        <script>
            texto = "{{ $modulo->descripcion }}"; // Captura la descripción del módulo actual
            document.getElementById("descripcion-{{ $modulo->id }}").textContent = truncate(texto, 100); // Trunca y muestra en el elemento correspondiente

            function truncate(text, length) {
                if (text.length <= length) {
                    return text;
                } else {
                    return text.substring(0, length - 3) + "...";
                }
            }
        </script>
    @endforeach
</div>

<div class="card" id="evaluaciones-card" style="display: none;">
    <div class="card-header">
        <h3 class="card-title">Evaluaciones</h3>
    </div>
    <div class="card-body">
        <!-- Content for evaluations card -->
    </div>
</div>

@stop

<script>
    // Function to check if all buttons are visto and enable card
    function checkAllVisto() {
        let allButtons = document.querySelectorAll('.ver-articulo');
        let allVisto = true; // Assuming all buttons are visto initially

        for (let button of allButtons) {
            if (!button.classList.contains('btn-success')) {
                allVisto = false;
                break;
            }
        }

        if (allVisto) {
            // Enable card if all buttons are visto
            document.getElementById('evaluaciones-card').style.display = 'block';
        } else {
            document.getElementById('evaluaciones-card').style.display = 'none';
        }
    }
</script>