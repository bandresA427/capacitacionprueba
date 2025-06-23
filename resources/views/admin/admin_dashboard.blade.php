@extends('adminlte::page')
<link rel="stylesheet" href="{{ asset('../resources/css/custom.css') }}" />

@section('title', 'Panel Administrador')

@section('content_header')
@auth
<h1 class="welcome-title">Bienvenido, {{ Auth::user()->name }}!</h1>
@endauth
@stop

@section('content')
<img src="fondo.png" alt="" height="40%" width="99%"></img>
<div class="row">

    <div class="col-lg-4 col-9">
        <div class="card card-outline-primary shadow-lg ml-2 mt-2 card-md" style="border-radius: 20px; ">
            <div class="card-header" style="background-image: url('jeanlightblue.jpg'); color:white;">
                <h1 style="height: 120px;"> Usuarios<i class="fas fa-fw fa-user" style="float: right; "></i> </h1>
            </div>
            <div class="card-body" style="height: 100px;">
                <p>Dentro de este menú podrás realizar la creaciónn de nuevos usuarios.</p>
            </div>
            <a href="{{ url('/users') }}"  class="btn btn-sm btn-primary" style="background-color:#0e4a80; font-size: 20px;">Ingresar  </a>
        </div>
    </div>
    

    <div class="col-lg-4 col-9">
        <div class="card card-outline-primary shadow-lg ml-2 mt-2 card-md" style="border-radius: 20px; ">
            <div class="card-header" style="background-image: url('jeanlightblue.jpg'); color:white;">
                <h1 style="height: 120px;"> Evaluaciones<i class="fas fa-check" style="float: right; "></i> </h1>
            </div>
            <div class="card-body" style="height: 100px;">
                <p>Dentro de este menú podrás realizar las evaluaciones para ser completadas por el usuario.</p>
            </div>
            <a href="{{ url('/evaluaciones') }}"  class="btn btn-sm btn-primary" style="background-color:#0e4a80; font-size: 20px;">Ingresar  </a>
        </div>
    </div>

    <div class="col-lg-4 col-9">
        <div class="card card-outline-primary shadow-lg ml-2 mt-2 card-md" style="border-radius: 20px; ">
            <div class="card-header" style="background-image: url('jeanlightblue.jpg'); color:white;">
                <h1 style="height: 120px;"> Módulos <i class="fas fa-book" style="float: right; "></i> </h1>
            </div>
            <div class="card-body" style="height: 100px;">
                <p>Crea los módulos y articulos dentro del curso de capacitación. </p>
            </div>
            <a href="{{ url('/capacitacion/modulos') }}"   class="btn btn-sm btn-primary" style="background-color:#0e4a80; font-size: 20px;">Ingresar  </a>
        </div>
    </div>

    <div class="col-lg-4 col-9">
        <div class="card card-outline-primary shadow-lg ml-2 mt-2 card-md" style="border-radius: 20px; ">
            <div class="card-header" style="background-image: url('jeanlightblue.jpg'); color:white;">
                <h1 style="height: 120px;"> Auditorias <i class="fas fa-solid fa-list" style="float: right; "></i> </h1>
            </div>
            <div class="card-body" style="height: 100px;">
                <p>Dentro de este menú se puede acceder a las auditorias del sistema.</p>
            </div>
            <a href="{{ url('/audit-log') }}" class="btn btn-sm btn-primary" style="background-color:#0e4a80; font-size: 20px;" >Ingresar  </a>
        </div>
    </div>

    <div class="col-lg-4 col-9">
        <div class="card card-outline-primary shadow-lg ml-2 mt-2 card-md" style="border-radius: 20px; ">
            <div class="card-header" style="background-image: url('jeanlightblue.jpg'); color:white;">
                <h1 style="height: 120px;"> Respaldos <i class="fas fa-solid fa-database" style="float: right; "></i> </h1>
            </div>
            <div class="card-body" style="height: 100px;">
                <p>Crea una migración o restaura la base de datos.</p>
            </div>
            <a href="{{ url('/database') }}" class="btn btn-sm btn-primary" style="background-color:#0e4a80;font-size: 20px;">Ingresar  </a>
        </div>
    </div>

    <div class="col-lg-4 col-9">
        <div class="card card-outline-primary shadow-lg ml-2 mt-2 card-md" style="border-radius: 20px; ">
            <div class="card-header" style="background-image: url('jeanlightblue.jpg'); color:white;">
                <h1 style="height: 120px;"> Prácticas  <i class="fas fa-solid fa-toolbox" style="float: right; "></i> </h1>
            </div>
            <div class="card-body" style="height: 100px;">
                <p>Cargar los datos de prácticas de los empleados.</p>
            </div>
            <a href="{{url('/practicas')}}" class="btn btn-sm btn-primary" style="background-color:#0e4a80;font-size: 20px;">Ingresar  </a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header" style="background-color: #00004d;">
                <div class="card-title" style="color: white;">Usuarios Registrados Este Mes</div>
            </div>
            <div class="card-body">
                <canvas id="userChart"></canvas>
                <h2 class="font-size-lg">{{ $userCount }}</h2>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header" style="background-color: #00004d;">
                <div class="card-title" style="color: white;">Módulos Registrados Este Mes</div>
            </div>
            <div class="card-body">
                <canvas id="moduleChart"></canvas>
                <h2 class="font-size-lg">{{ $moduleCount }}</h2>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header" style="background-color: #00004d;">
                <div class="card-title" style="color: white;">Evaluaciones Registradas Este Mes</div>
            </div>
            <div class="card-body">
                <canvas id="evaluationChart"></canvas>
                <h2 class="font-size-lg">{{ $evaluationCount }}</h2>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const userChartCtx = document.getElementById('userChart').getContext('2d');
        const moduleChartCtx = document.getElementById('moduleChart').getContext('2d');
        const evaluationChartCtx = document.getElementById('evaluationChart').getContext('2d');

        const userChart = new Chart(userChartCtx, {
            type: 'pie', // Cambiado a 'pie'
            data: {
                labels: ['Usuarios Registrados Este Mes'],
                datasets: [{
                    label: '# de Usuarios',
                    data: [{{ $userCount }}],
                    backgroundColor: ['rgba(75, 192, 192, 0.2)'],
                    borderColor: ['rgba(75, 192, 192, 1)'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true
            }
        });

        const moduleChart = new Chart(moduleChartCtx, {
            type: 'pie', // Cambiado a 'pie'
            data: {
                labels: ['Módulos Registrados Este Mes'],
                datasets: [{
                    label: '# de Módulos',
                    data: [{{ $moduleCount }}],
                    backgroundColor: ['rgba(153, 102, 255, 0.2)'],
                    borderColor: ['rgba(153, 102, 255, 1)'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true
            }
        });

        const evaluationChart = new Chart(evaluationChartCtx, {
            type: 'pie', // Cambiado a 'pie'
            data: {
                labels: ['Evaluaciones Registradas Este Mes'],
                datasets: [{
                    label: '# de Evaluaciones',
                    data: [{{ $evaluationCount }}],
                    backgroundColor: ['rgba(255, 159, 64, 0.2)'],
                    borderColor: ['rgba(255, 159, 64, 1)'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true
            }
        });
    });
</script>

@stop
