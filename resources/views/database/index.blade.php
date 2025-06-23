@extends('adminlte::page')

@section('title', 'Administración de base de datos')

@section('content_header')
    <h1>Administración de base de datos</h1>
@endsection

@section('content')
    <div class="container">
        <div class="row">
        <form action="{{ route('database.migrate') }}" method="post">
    @csrf
    <button type="submit" class="btn btn-primary">Migrar base de datos</button>
</form>
            <div class="col-md-6">
                <form action="{{ route('database.restore') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="backup">Seleccionar archivo de copia de seguridad:</label>
                        <input type="file" class="form-control" id="backup" name="backup" required>
                    </div>
                    <button type="submit" class="btn btn-success">Restaurar base de datos</button>
                </form>
            </div>
        </div>

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
