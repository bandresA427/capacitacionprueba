@extends('adminlte::page')
<link rel="stylesheet" href="{{ asset('../resources/css/custom.css') }}"/>

@section('content')
<br>
<div class="row">
    <div class="col-md-3"></div>
    <div class="card col-lg-6">
        <div class="card-header row">
            <h2 class="col-md-10">Editar usuario</h2>
            <a href="{{route('users.index')}}" class="btn btn-info btn-sm ">Volver</a>
        </div>
        <div class="card-body">
            
        <form method="POST" action="{{ route('users.update', $user->id) }}">
        @csrf
        @method('PUT')
                
                <div>
                <label for="nacionalidad">Nacionalidad</label>
                    <select class="form-control" name="nacionalidad" id="nacionalidad" disabled>
                        <option value="V">V</option>
                        <option value="E">E</option>
                    </select>
                    <label for="cedula">Cédula de identidad:</label>
                    <input type="number" class="form-control" name="cedula" id="cedula" value="{{ $user->cedula }}" disabled>
                </div>
                <div>
                    <label for="name">Nombre y Apellido:</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}" disabled>
                </div>
                <div>
                    <label for="direccion">Dirección:</label>
                    <input type="text" class="form-control" name="direccion" id="direccion" value="{{ $user->direccion }}" >
                </div>
                <div>
                    <label for="telefono">Teléfono:</label>
                    <input type="number" class="form-control" name="telefono" id="telefono" value="{{ $user->telefono }}" >
                </div>
                <div>
                    <label for="email">Correo Electrónico:</label>
                    <input type="email" class="form-control" name="email" id="email" value="{{$user->email}}" required>
                </div>
                <div>
                    <label for="password">Contraseña:</label>
                    <input type="password" class="form-control" name="password" id="password" value="{{$user->password}}" >
                </div>
                <div>
                    <label for="usertype">Tipo de Usuario:</label>
                    <select class="form-control" name="usertype" id="usertype" required>
                        <option value="admin">Administrador</option>
                        <option value="user">Usuario</option>
                        <option value="instructor">Instructor</option>
                    </select>
                </div>
                <div>

                    <label for="status">Estado del Usuario:</label>
                    <select class="form-control" name="status" id="status" required>
                        <option value="Activo">Activo</option>
                        <option value="Retirado">Retirado</option>
                    </select>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-5"></div>
                    <button type="submit" class="btn btn-info .btn-sm" name="btn-ActualizarUsuario" value="ActualizarUsuario">Actualizar Usuario</button>

                </div>
            </form>
        </div>
        <br>
    </div>
</div>
@stop