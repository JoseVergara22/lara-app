<?php

use Illuminate\Support\Facades\Route; ///Para definir rutas
use GuzzleHttp\Client;                //para realizar consultas http
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
| 
|    1. Listar a los usuarios.
|    2. Listar publicaciones. (posts)
|    3. Consultar álbumes de un usuario en específico.
|    4. Editar registro de una petición(usuarios).
|    5. Eliminar registro de una petición(usuarios).
|    6. Listar Registros de peticiones realizadas
| 
| 
*/
// Route::middleware([LogRequestMiddleware::class])->group(function () {}

// Ruta ppal por defecto de laravel
Route::get('/', function () {
    return view('welcome');
});

/// Conseguir usuarios, posts y albums de cada usuario.

Route::get('/users', [HomeController::class, 'listUsers']);
Route::get('/posts', [HomeController::class, 'listPosts']);
Route::get('/user/{userId}/albums', [HomeController::class, 'getUserAlbums']);

///Editar usuariio

Route::get('/edit/user/{userId}', [HomeController::class, 'showEditForm'])->name('edit.user');
Route::post('/edit/user/{userId}', [HomeController::class, 'editUser'])->name('update.user');

// Ruta para mostrar los cambios
Route::get('/user/{userId}/details', [HomeController::class, 'showUserDetails'])->name('user.details');


// Ruta para eliminar usuario
Route::delete('/delete/user/{userId}', [HomeController::class, 'deleteUser'])->name('delete.user');

// Ruta para mostrar que sucedio la accion
Route::get('/list/users/delete', [HomeController::class, 'listUsers'])->name('list.users');