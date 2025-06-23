@extends('adminlte::page')

@section('title', 'Restaurar base de datos')

@section('content_header')
    <h1>Restaurar base de datos</h1>
@endsection

@section('content')
    <div class="container">
        <form action="{{ route('database.restore') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="backup">Seleccionar archivo de copia de seguridad:</label>
                <input type="file" class="form-control" id="backup" name="backup" required>
            </div>
            <button type="submit" class="btn btn-success">Restaurar base de datos</button>
        </form>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
    </div>
@endsection
