<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CapacitacionArticuloController;
use App\Http\Controllers\CapacitacionModuloController;
use App\Http\Controllers\EvaluacionController;
use App\Http\Controllers\RespuestaController;
use App\Http\Controllers\CertificadoController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\AuditController;
use App\Http\Controllers\DatabaseController;
use App\Http\Controllers\descargarPDFController;
use App\Http\Controllers\CalificacionesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\practicasController;
use App\Http\Controllers\practicasPatrullajeController;
use App\Http\Controllers\practicasComportamientoController;
use App\Http\Controllers\practicasCalidadController;
use App\Http\Controllers\practicasOperacionesController;
use App\Http\Controllers\practicasInformacionController;
use App\Http\Controllers\practicasPatrullajeInformacionController;
use App\Http\Controllers\practicasOperacionesInformacionController;
use App\Http\Controllers\practicasCalidadInformacionController;
use App\Http\Controllers\practicasComportamientoInformacionController;






/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', destination:'login');

Route::get('../public/', function () {
    return view('../public/');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';

//rutas nuevas
Route::get('/admin/dashboard', [AdminController::class, 'adminDashboard'])->name('admin.dashboard');

// Rutas de usuarios --------------------------------------------------------------------------------------------------

// Ruta para mostrar la lista de usuarios
Route::get('/users', [UsersController::class, 'index'])->name('users.index');
// Ruta para mostrar el formulario de creación de usuarios
Route::get('/users/create', [UsersController::class, 'create'])->name('users.create');
// Ruta para guardar el nuevo usuario
Route::post('/users', [UsersController::class, 'store'])->name('users.store');
// Ruta para mostrar el formulario de edición de usuarios
Route::get('/users/{user}/edit', [UsersController::class, 'edit'])->name('users.edit');
// Ruta para actualizar el usuario
Route::put('/users/{user}', [UsersController::class, 'update'])->name('users.update');
// Ruta para eliminar un usuario
Route::delete('/users/{user}', [UsersController::class, 'destroy'])->name('users.destroy');

//Rutas capacitacion---------------------------------------------------------------------------------------------------

Route::get('/capacitacion/modulos', [CapacitacionModuloController::class, 'index'])->name('capacitacion.modulos.index');
Route::get('/capacitacion/modulos/create', [CapacitacionModuloController::class, 'create'])->name('capacitacion.modulos.create');
Route::get('/capacitacion/modulos/{modulo}/edit', [CapacitacionModuloController::class, 'edit'])->name('capacitacion.modulos.edit');
Route::put('/capacitacion/modulos/{modulo}', [CapacitacionModuloController::class, 'update'])->name('capacitacion.modulos.update');
Route::delete('/capacitacion/modulos/{modulo}', [CapacitacionModuloController::class, 'destroy'])->name('capacitacion.modulos.destroy');

Route::post('/capacitacion/modulos', [CapacitacionModuloController::class, 'store'])->name('capacitacion.modulos.store');
Route::get('/capacitacion/modulos/{modulo}/show', [CapacitacionModuloController::class, 'show'])->name('capacitacion.modulos.show');

Route::get('/capacitacion/modulos/{modulo}/articulos', [CapacitacionArticuloController::class, 'index'])->name('capacitacion.modulos.articulos.index');
Route::get('/capacitacion/modulos/{modulo}/articulos/create', [CapacitacionArticuloController::class, 'create'])->name('capacitacion.modulos.articulos.create');
Route::delete('/capacitacion/modulos/{modulo}/articulos/{articulos}', [CapacitacionArticuloController::class, 'destroy'])->name('capacitacion.modulos.articulos.destroy');

Route::post('/capacitacion/modulos/{modulo}/articulos', [CapacitacionArticuloController::class, 'store'])->name('capacitacion.modulos.articulos.store');
Route::get('/capacitacion/modulos/{modulo}/articulos/{articulos}/show', [CapacitacionArticuloController::class, 'show'])->name('capacitacion.modulos.articulos.show');

Route::get('/capacitacion/modulos/{modulo}/articulos/{articulos}/next', [CapacitacionArticuloController::class, 'nextArticle'])->name('capacitacion.modulos.articulos.next');
//Rutas evaluacion-------------------------------------------------------------------------------------------------------


Route::get('/evaluaciones', [EvaluacionController::class, 'index'])->name('evaluaciones.index');
Route::get('/evaluaciones/create', [EvaluacionController::class, 'create'])->name('evaluaciones.create');
Route::post('/evaluaciones', [EvaluacionController::class, 'store'])->name('evaluaciones.store');
Route::get('/evaluaciones/{evaluacion}/edit', [EvaluacionController::class, 'edit'])->name('evaluaciones.edit');
Route::put('/evaluaciones/{evaluacion}', [EvaluacionController::class, 'update'])->name('evaluaciones.update');
Route::get('/evaluaciones/{evaluacion}', [EvaluacionController::class, 'show'])->name('evaluaciones.show');
Route::post('/respuestas/store', [RespuestaController::class, 'store'])->name('respuestas.store');
Route::post('/evaluaciones/{evaluacion}/respuestas', [RespuestaController::class, 'store'])->name('evaluaciones.respuestas.store');
Route::delete('/evaluaciones/{evaluacion}', [EvaluacionController::class, 'destroy'])->name('evaluaciones.destroy');
Route::get('/evaluaciones/{evaluacion}/resultados', [EvaluacionController::class, 'Resultados'])->name('evaluaciones.resultados');
Route::get('/evaluaciones/{evaluacion?}/resultados',function (string $evaluacion=null){

    return $evaluacion;

});


//Rutas certificado -----------------------------------------------------------------------------------------------------

Route::get('/certificado/{user}', [CertificadoController::class, 'generar'])->name('certificado');

//Rutas Reportes -----------------------------------------------------------------------------------------------------
Route::get('/reportes', [ReporteController::class, 'index'])->name('reportes.index');
Route::get('/reportes/reporte-usuarios', [ReporteController::class, 'usuarios'])->name('reporte-usuarios');
Route::get('/reportes/reporte-evaluaciones', [ReporteController::class, 'evaluaciones'])->name('reporte-evaluaciones');
Route::get('/reportes/reporte-culminados', [ReporteController::class, 'culminados'])->name('reporte-culminados');
Route::get('/reportes/generar-Reporte', [ReporteController::class, 'generarReporte'])->name('generar-reporte');
Route::get('/reportes/generar-Reporte-Usuarios', [ReporteController::class, 'generarReporteUsuarios'])->name('generar-reporte-usuarios');
Route::get('/reportes/generar-Reporte-Evaluaciones', [ReporteController::class, 'generarReporteEvaluaciones'])->name('generar-reporte-evaluaciones');
Route::get('/reportes/generar-Reporte-Culminados', [ReporteController::class, 'generarReporteCulminados'])->name('generar-reporte-culminados');

//Rutas auditoria -----------------------------------------------------------------------------------------------------
Route::get('/audit-log', [AuditController::class, 'index'])->name('audit.index');

//Rutas migracion -----------------------------------------------------------------------------------------------------
Route::get('/database', [DatabaseController::class, 'index'])->name('database.index');
Route::post('/database/migrate', [DatabaseController::class, 'migrate'])->name('database.migrate');
Route::post('/database/restore', [DatabaseController::class, 'restore'])->name('database.restore');

//Ruta descarga del manual--------------------------------------------------------------------------------------------

Route::get('/Descargar-Manual', [descargarPDFController::class, 'Descargar'])->name('descargar-manual');

//Modificar puntaje de las calificaciones -----------------------------------------------------------------------------

Route::get('/calificaciones', [CalificacionesController::class, 'index'])->name('calificaciones.index');
Route::get('/calificaciones/{evaluacionId}', [CalificacionesController::class, 'show'])->name('calificaciones.show');
Route::post('/calificaciones/{evaluacionId}/{usuarioId}/aprobar-reprobar', [CalificacionesController::class, 'aprobarReprobar'])->name('calificaciones.aprobarReprobar');


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

//Prácticas de los empleados en la institución-------------------------------------------------------------------------

//index de todos las practicas 
Route::get('/practicas', [practicasController::class, 'index'])->name('practicas.index');

// crear de cada una de las practicas
Route::get('/practicas/crear', [practicasController::class, 'crearPractica'])->name('practicas.crearpractica');
Route::get('/practicas/crear-patrullaje', [practicasPatrullajeController::class, 'crearPractica'])->name('practicas.crearpractica2');
Route::get('/practicas/crear-Operaciones', [practicasOperacionesController::class, 'crearPractica'])->name('practicas.crearpractica3');
Route::get('/practicas/crear-Calidad', [practicasCalidadController::class, 'crearPractica'])->name('practicas.crearpractica4');
Route::get('/practicas/crear-Comportamiento', [practicasComportamientoController::class, 'crearPractica'])->name('practicas.crearpractica5');

// editar de cada una de las practicas  
Route::get('/practicas/{practicas}/editar', [practicasController::class, 'editarpractica'])->name('practicas.editarpractica');
Route::get('/practicas/patrullaje/{patrullaje}/editar', [practicasPatrullajeController::class, 'editarpractica'])->name('practicas.editarpractica2');
Route::get('/practicas/operaciones/{operaciones}/editar', [practicasOperacionesController::class, 'editarpractica'])->name('practicas.editarpractica3');
Route::get('/practicas/calidad/{calidad}/editar', [practicasCalidadController::class, 'editarpractica'])->name('practicas.editarpractica4');
Route::get('/practicas/comportamiento/{comportamiento}/editar', [practicasComportamientoController::class, 'editarpractica'])->name('practicas.editarpractica5');

// guardar de cada una de las patracticas 
Route::post('/practicas', [practicasController::class, 'guardarpractica'])->name('practicas.guardarpractica');
Route::post('/practicas/patrullaje', [practicasPatrullajeController::class, 'guardarpractica'])->name('practicas.guardarpractica2');
Route::post('/practicas/operaciones', [practicasOperacionesController::class, 'guardarpractica'])->name('practicas.guardarpractica3');
Route::post('/practicas/calidad', [practicasCalidadController::class, 'guardarpractica'])->name('practicas.guardarpractica4');
Route::post('/practicas/comportamiento', [practicasComportamientoController::class, 'guardarpractica'])->name('practicas.guardarpractica5');

// store de cada una de las practicas 
Route::put('/practicas/{practicas}', [practicasController::class, 'guardarpracticaeditada'])->name('practicas.guardarpracticaeditada');
Route::put('/practicas/patrullaje/{patrullaje}', [practicasPatrullajeController::class, 'guardarpracticaeditada'])->name('practicas.guardarpracticaeditada2');
Route::put('/practicas/operaciones/{operaciones}', [practicasOperacionesController::class, 'guardarpracticaeditada'])->name('practicas.guardarpracticaeditada3');
Route::put('/practicas/calidad/{calidad}', [practicasCalidadController::class, 'guardarpracticaeditada'])->name('practicas.guardarpracticaeditada4');
Route::put('/practicas/comportamiento/{comportamiento}', [practicasComportamientoController::class, 'guardarpracticaeditada'])->name('practicas.guardarpracticaeditada5');

// Delete de cada una de las practicas
Route::delete('/practicas/{practicas}', [practicasController::class, 'eliminarpractica'])->name('practicas.eliminarpractica');
Route::delete('/practicas/patrullaje/{patrullaje}', [practicasPatrullajeController::class, 'eliminarpractica'])->name('practicas.eliminarpractica2');
Route::delete('/practicas/operaciones/{operaciones}', [practicasOperacionesController::class, 'eliminarpractica'])->name('practicas.eliminarpractica3');
Route::delete('/practicas/calidad/{calidad}', [practicasCalidadController::class, 'eliminarpractica'])->name('practicas.eliminarpractica4');
Route::delete('/practicas/comportamiento/{comportamiento}', [practicasComportamientoController::class, 'eliminarpractica'])->name('practicas.eliminarpractica5');

// visualizar informacion de las practicas 
Route::get('/practicas/{practicas}', [practicasInformacionController::class, 'index'])->name('practicas.informacion.index');
Route::get('/practicas/patrullaje/{patrullaje}', [practicasPatrullajeInformacionController::class, 'index'])->name('practicas.informacion.index2');
Route::get('/practicas/operaciones/{operaciones}', [practicasOperacionesInformacionController::class, 'index'])->name('practicas.informacion.index3');
Route::get('/practicas/calidad/{calidad}', [practicasCalidadInformacionController::class, 'index'])->name('practicas.informacion.index4');
Route::get('/practicas/comportamiento/{comportamiento}', [practicasComportamientoInformacionController::class, 'index'])->name('practicas.informacion.index5');


// cargaMasiva de cada una de las practicas
Route::post('/practicas', [practicasInformacionController::class, 'cargaMasiva'])->name('practicas.informacion.cargaMasiva');
Route::post('/practicas/patrullaje', [practicasPatrullajeInformacionController::class, 'cargaMasiva'])->name('practicas.informacion.cargaMasiva2');
Route::post('/practicas/operaciones', [practicasOperacionesInformacionController::class, 'cargaMasiva'])->name('practicas.informacion.cargaMasiva3');
Route::post('/practicas/calidad', [practicasCalidadInformacionController::class, 'cargaMasiva'])->name('practicas.informacion.cargaMasiva4');
Route::post('/practicas/comportamiento', [practicasComportamientoInformacionController::class, 'cargaMasiva'])->name('practicas.informacion.cargaMasiva5');



Route::get('/practicas/imprimir',[practicasController::class, 'imprimir'])->name('practicas.imprimir');



Route::get('/practicas/{practicas}/{practicasinformacion}/editar', [practicasInformacionController::class, 'editar'])->name('practicas.informacion.editar');
Route::put('/practicas/{practicasinformacion}', [practicasInformacionController::class, 'update'])->name('practicas.informacion.update');
Route::delete('/practicas/{practicasinformacion}', [practicasInformacionController::class, 'delete'])->name('practicas.informacion.delete');

