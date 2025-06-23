@extends('adminlte::page')
<link rel="stylesheet" href="{{ asset('../resources/css/custom.css') }}" />

@section('title', 'Usuarios')

@section('content')
@if(Auth::user()->usertype=='admin' )
<br>

<div class="card">
    <div class="card-header row">
        <h3 class="card-title col-md-6"><b>Lista de Usuarios</b></h3>
        <div class="float-right mr-2">
            <a href="{{route('home')}}" class="btn btn-info btn-sm"><i class="fas fa-arrow-left"></i> Volver</a>
            <a type="submit" name="ModuloEvaluaciones" value="ModuloEvaluaciones" class="btn btn-info btn-sm" href="{{ url('/users/create') }}"><i class="fas fa-user-plus"></i> Nuevo usuario</a>
        </div>
    </div>

    <div class="card-body">
        <table id="users-table" class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>Correo</th>
                    <th>Rol</th>
                    <th>Estatus</th>
                    <th>Acciones</th>
                    <th>Certificación</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->direccion }}</td>
                    <td>{{ $user->telefono }}</td>
                    <td>{{ $user->email }}</td>
                    <td>@if($user->usertype == 'user') Empleado @elseif($user->usertype == 'admin') Administrador @else($user->usertype == 'instructor') Instructor @endif</td>
                    <td>{{ $user->status }}</td>
                    <td><a type="submit" class="btn btn-info btn-sm" title='Editar información del usuario' href="{{ route('users.edit', $user->id) }}"><i class="fas fa-pencil-alt"></i></a></td>
                    @if(  $user->nivel == 7 )
                    <td><a href="{{ route('certificado',  $user->id ) }}" class="btn btn-info btn-sm " title='Imprimir certificado'><i class="fas fa-check"></i></a></td>
                    @endif
                </tr>

                @endforeach
            </tbody>
        </table>
        <br>
        </div>
</div>

@endif

@if(Auth::user()->usertype=='user' )
<p>No posee acceso a este modulo, por favor vuelva al menu principal.</p>
@endif

@endsection