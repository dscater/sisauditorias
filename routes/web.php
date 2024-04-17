<?php

use App\Http\Controllers\EtapaAuditoriaController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\InstitucionController;
use App\Http\Controllers\MultimediaController;
use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicacionController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\TipoTrabajoController;
use App\Http\Controllers\TrabajoAuditoriaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::get('/', function () {

    return Inertia::render('Inicio');
});

Route::get('/login', function () {
    if (Auth::check()) {
        return redirect()->route('inicio');
    }
    return Inertia::render('Auth/Login');
});

Route::get("institucions/getInstitucion", [InstitucionController::class, 'getInstitucion'])->name("institucions.getInstitucion");

Route::middleware('auth')->group(function () {
    // INICIO
    Route::get('/inicio', [InicioController::class, 'inicio'])->name('inicio');

    // INSTITUCION
    Route::resource("institucions", InstitucionController::class)->only(
        ["index", "show", "update"]
    );

    // PUBLICACIONS
    Route::resource("publicacions", PublicacionController::class)->only(
        ["index", "show", "store", "update"]
    );

    // NOTICIAS
    Route::resource("noticias", NoticiaController::class)->only(
        ["index", "show", "store", "update"]
    );

    // MULTIMEDIAS
    Route::resource("multimedias", MultimediaController::class)->only(
        ["index", "show", "store", "update"]
    );

    // USUARIO
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/update_foto', [ProfileController::class, 'update_foto'])->name('profile.update_foto');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get("/getUser", [UserController::class, 'getUser'])->name('users.getUser');
    Route::get("/permisos", [UserController::class, 'permisos']);
    Route::get("/menu_user", [UserController::class, 'permisos']);

    // USUARIOS
    Route::put("/usuarios/password/{user}", [UsuarioController::class, 'actualizaPassword'])->name("usuarios.password");
    Route::get("/usuarios/paginado", [UsuarioController::class, 'paginado'])->name("usuarios.paginado");
    Route::get("/usuarios/listado", [UsuarioController::class, 'listado'])->name("usuarios.listado");
    Route::get("/usuarios/listado/byTipo", [UsuarioController::class, 'byTipo'])->name("usuarios.byTipo");
    Route::get("/usuarios/show/{user}", [UsuarioController::class, 'show'])->name("usuarios.show");
    Route::put("/usuarios/update/{user}", [UsuarioController::class, 'update'])->name("usuarios.update");
    Route::delete("/usuarios/{user}", [UsuarioController::class, 'destroy'])->name("usuarios.destroy");
    Route::resource("usuarios", UsuarioController::class)->only(
        ["index", "store"]
    );

    // TIPOS DE TRABAJOS
    Route::get("/tipo_trabajos/paginado", [TipoTrabajoController::class, 'paginado'])->name("tipo_trabajos.paginado");
    Route::get("/tipo_trabajos/listado", [TipoTrabajoController::class, 'listado'])->name("tipo_trabajos.listado");
    Route::resource("tipo_trabajos", TipoTrabajoController::class)->only(
        ["index", "store", "update", "show", "destroy"]
    );


    // TRABAJOS DE AUDITORIAS
    Route::get("/trabajo_auditorias/paginado", [TrabajoAuditoriaController::class, 'paginado'])->name("trabajo_auditorias.paginado");
    Route::get("/trabajo_auditorias/listado", [TrabajoAuditoriaController::class, 'listado'])->name("trabajo_auditorias.listado");
    Route::resource("trabajo_auditorias", TrabajoAuditoriaController::class)->only(
        ["index", "create", "store", "edit", "update", "show", "destroy"]
    );


    // ETAPAS DE AUDITORIAS
    Route::get("/etapa_auditorias/paginado", [EtapaAuditoriaController::class, 'paginado'])->name("etapa_auditorias.paginado");
    Route::get("/etapa_auditorias/listado", [EtapaAuditoriaController::class, 'listado'])->name("etapa_auditorias.listado");
    Route::resource("etapa_auditorias", EtapaAuditoriaController::class)->only(
        ["index", "create", "store", "edit", "update", "show", "destroy"]
    );

    // REPORTES
    Route::get('reportes/usuarios', [ReporteController::class, 'usuarios'])->name("reportes.usuarios");
    Route::get('reportes/r_usuarios', [ReporteController::class, 'r_usuarios'])->name("reportes.r_usuarios");
});

require __DIR__ . '/auth.php';
