@extends('adminlte::page')

@section('title', 'Artículos del Módulo '. $modulo->titulo)

@section('content_header')
    <h1>Artículos del Módulo {{ $modulo->titulo }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <a href="{{ route('capacitacion.modulos.index' )}}" class="btn btn-info btn-sm mb-2"><i class="fas fa-arrow-left"></i> Volver</a>
            @if(Auth::user()->usertype == 'admin')
                <a href="{{ route('capacitacion.modulos.articulos.create', $modulo) }}" class="btn btn-info btn-sm mb-2"><i class="fas fa-plus"></i> Agregar Artículo</a>
            @endif
            <hr>
            <br>
            <p class="col-lg-12 col-6" style="white-space: pre-wrap; font-size: 18px;">{{ $modulo->descripcion }}</p>
            <br><br>
            <div class="row">
                @foreach ($articulos as $articulo)
                    <div class="col-lg-4">
                        <div class="card card-primary card-outline-primary shadow-lg ml-2 mt-2 card-md" style=" border-radius: 20px;width: 280px; height: 350px;">
                            <div class="card-header" style="background-color: {{$modulo->color}}; border-radius: 15px"></div>
                            <div class="card-body">
                                <br>
                                <b>
                                    <h4>{{ $articulo->titulo }}</h4>
                                </b>
                                <br>
                                <p id="descripcion-{{ $articulo->id }}" style="margin-bottom: 20px; font-size: 16px;"></p>
                                <div class="ml-auto mr-auto mb-auto">
                                    <a href="{{ route('capacitacion.modulos.articulos.show', [$modulo, $articulo]) }}" class="btn btn-info btn-sm mb-2"><i class="fas fa-eye"></i> Ver artículo</a>
                                </div>
                            </div>
                            <img src="../../../jeanlightblue.jpg" style="width:280px; height:70px;">
                        </div>
                    </div>

                    <script>
                        texto = "{{ $articulo->informacion }}"; // Captura la descripción del módulo actual
                        document.getElementById("descripcion-{{ $articulo->id }}").textContent = truncate(texto, 100); // Trunca y muestra en el elemento correspondiente

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
        </div>
    </div>
@stop