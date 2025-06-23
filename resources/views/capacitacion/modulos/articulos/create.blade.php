@extends('adminlte::page')
<link rel="stylesheet" href="{{ asset('../resources/css/custom.css') }}"/>

@section('content')
<div class="card">
    <div class="card-body">
    <a href="{{ route('capacitacion.modulos.articulos.index', $modulo->id) }}" class="btn btn-info btn-sm "><i class="fas fa-arrow-left ">Volver</i></a>
    <br><br>
        <form action="{{ route('capacitacion.modulos.articulos.store', $modulo) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="titulo">Título:</label>
                <input type="text" name="titulo" id="titulo" class="form-control" placeholder="Requerido*" required>
            </div>

            <div class="form-group">
                <label for="contenido">Contenido:</label>
                <textarea name="contenido" id="contenido" class="form-control" rows="10" placeholder="Requerido*"></textarea>
            </div>
            <div>

                    <label for="visto">Activar Evaluacion en este articulo:</label>
                    <select class="form-control" name="visto" id="visto" required>
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
            

            <button type="submit" class="btn btn-info"name="btn-CrearArticulo" value="CrearArticulo">Guardar</button>
        </form>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('ckeditor5/build/ckeditor.js') }}"></script>
<script src="https://cdn.ckbox.io/ckbox/latest/ckbox.js"></script>

<script>

    ClassicEditor
        .create(document.querySelector('#contenido'), {
        image: {
            toolbar: [
                'imageUpload',
                'imageTextAlternative',
                'imageStyle:full',
                'imageStyle:side',
                'imageStyle:alignLeft',
                'imageStyle:alignCenter',
                'imageStyle:alignRight'
            ]
        }
        });
</script>
@endsection