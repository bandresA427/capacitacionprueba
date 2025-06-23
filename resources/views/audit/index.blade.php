@extends('adminlte::page')
<link rel="stylesheet" href="{{ asset('../resources/css/custom.css') }}"/>

@section('title', 'Registro de auditoría')

@section('content_header')
    <h1>Registro de auditoría</h1>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('audit.index') }}" method="GET">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="type">Tipo:</label>
                            <select class="form-control" id="type" name="type">
                                <option value="">Todos</option>
                                <option value="click">Clic</option>
                                <option value="submit">Enviar</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="date_from">Fecha desde:</label>
                            <input type="date" class="form-control" id="date_from" name="date_from">
                        </div>
                        <div class="col-md-4">
                            <label for="date_to">Fecha hasta:</label>
                            <input type="date" class="form-control" id="date_to" name="date_to">
                        </div>
                        <div class="col-md-4">
                            <label for="user_id">Usuario:</label>
                            <select class="form-control" id="user_id" name="user_id">
                                <option value="">Todos</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12 mt-2">
                            <button type="submit" class="btn btn-info btn-lg btn-filtrar"><i class="fas fa-filter"></i> Filtrar</button>
                        </div>
                    </div>
                </form>

                <hr>

                @if ($logs->count() > 0)
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Usuario</th>
                                <th>Tipo</th>
                                <th>Componente</th>
                                <th>Acción</th>
                                <th>URL</th>
                                <th>Tipo de Usuario</th>
                                <th>Fecha y hora</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($logs as $log)
                                <tr>
                                @foreach ($users as $user)
                                    @if($user->id == $log->user_id)
                                    <td>{{$user->name}}</td>
                                    @endif
                                    @endforeach
                                    
                                    <td>@if($log->type == 'submit' ) Enviar @else ($log->type == 'click' ) Click @endif</td>
                                    <td>{{ $log->component }}</td>
                                    <td>{{ $log->action }}</td>
                                    <td>{{ $log->url }}</td>
                                    
                                    <td>
                                        @foreach ($users as $user)
                                            @if($user->id == $log->user_id)
                                                @if($user->usertype == 'admin')
                                                    Administrador
                                                @elseif($user->usertype == 'instructor')
                                                    Instructor
                                                @else
                                                    Empleado
                                                @endif
                                            @endif
                                        @endforeach
                                    </td>
                                    
                                    <td>{{ $log->created_at->format('d/m/Y H:i:s') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $logs->links() }}
                @else
                    <p class="text-center">No se encontraron registros de auditoría.</p>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('css')
    <style>
        .table th, .table td {
            text-align: center;
        }


    </style>
@endsection
