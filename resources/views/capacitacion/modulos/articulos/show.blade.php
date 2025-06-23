@extends('adminlte::page')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
@section('content')
    <div class="card">
        <div class="card-body">
            <a href="{{ route('capacitacion.modulos.index', $modulo->id) }}" class="btn btn-primary btn-sm btn-volver">Volver</a>
            <h1 class="titulo">{{ $articulos->titulo }}</h1>
            <div class="content-container">
                {!! html_entity_decode($articulos->contenido) !!}
            </div>
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-4">
                    @if($articulos->visto != 0)
                        @if(Auth::user()->usertype == 'admin')
                            <a href="{{ route('capacitacion.modulos.index') }}" class="btn btn-primary btn-sm btn-siguiente">Finalizar Módulo</a>
                        @else
                            <div class="card card-primary card-outline-primary shadow-lg ml-2 mt-2 card-md align-items-center" style=" background-color: rgb(235, 239, 243); border-radius: 20px;width: 480px; height: 200px;">
                                <br>
                                <i class="fas fa-solid fa-book-open" style="color: {{$modulo->color}}; font-size: 25px;"></i>
                                <b>
                                    <h4>Evaluación {{$modulo->id}}</h4>
                                </b>
                                <div class="card-body">
                                    <div class="ml-auto mr-auto mb-auto">
                                        <a href="{{ route('evaluaciones.index') }}" class="btn btn-sm btn-primary" style="background-color: {{$modulo->color}};">Completar Evaluación</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @else
                        <a href="{{ route('capacitacion.modulos.articulos.next', [$modulo, $articulos]) }}" class="btn btn-primary btn-sm btn-siguiente">Siguiente</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/26.0.0/classic/ckeditor.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            ClassicEditor.create(document.querySelector("#editor"), {
                toolbar: ["heading", "|", "bold", "italic", "link", "bulletedList", "numberedList", "blockQuote"],
                language: "es",
            }).then(editor => {
                editor.isReadOnly = true;
            }).catch(error => {
                console.error(error);
            });
        });
    </script>
@endsection

<style>
    body {
  font-family: 'Open Sans', sans-serif; /* Change the font family to Open Sans */
  font-size: 18px; /* Increase the font size to 18px */
  line-height: 1.5; /* Add some line height to make the text more readable */
}

.titulo {
    font-size: 50px;
  font-weight: bold;
  text-align: left; /* Change the text alignment to left */
  margin-bottom: 40px;
  clear: both; /* Agrega esto para que el título no se mueva con el botón */
  margin-top: 20; /* Elimina el margen superior para que el título esté justo debajo del botón */

}

.content-container {
  font-size: 23px; /* Increase the font size of the content container to 20px */
  line-height: 1.5; /* Add some line height to make the text more readable */
  font-family: 'Open Sans', sans-serif; /* Change the font family to Open Sans */
  
}
.content-container img {
  width: 600px; /* Define a fixed width */
  height: 400px; /* Define a fixed height */
  margin: 20px;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
  display: block;
  margin: 0 auto;
  object-fit: cover;
  vertical-align: top;
  object-fit: contain; /* La imagen se ajusta al tamaño del contenedor */

}
.card-body {
  padding: 30px; /* Add some padding to the card body */
}
.content-container table {
  font-size: 20px; /* Cambia el tamaño de letra a 14 píxeles */
  font-family: 'Open Sans', sans-serif; /* Change the font family to Open Sans */
  
}
.btn {
  font-size: 26px !important;
  font-weight: 610 !important;
  line-height: 1.5 !important;
  padding: 12px 24px !important;
  border-radius:20px !important;
  border: none !important;
  background-color:  #0e4a80  !important;
  color: #fff !important;
  cursor: pointer !important;
  transition: background-color 0.2s ease !important;
  box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.3);

}

.btn:hover {
  background-color: #53738f !important;
  box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.3);

}

.btn-primary {
  background-color: #0e4a80 !important;
}

.btn-primary:hover {
  background-color:#53738f !important;
  box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.3);

}

.btn-sm {
    font-size: 20px !important;
  box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.3);

}

/* Alinear botones */


.btn-siguiente {
 
  float: right  !important;
  margin-left: 20px;


}

.btn-siguiente::after {
  font-family: 'Font Awesome 5 Free'; /* o la familia de fuentes de iconos que estés utilizando */
  content: "\f061"; /* código de flecha derecha */
  float: center  !important;
  margin-left: 20px;
 
}

.btn-volver::before {
  font-family: 'Font Awesome 5 Free'; /* o la familia de fuentes de iconos que estés utilizando */
  content: "\f060"; /* código de flecha izquierda */
  float: left;
  margin-right: 20px;
  display: block;
}

</style>