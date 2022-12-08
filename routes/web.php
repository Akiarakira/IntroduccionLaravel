<?php

// use Illuminate\Http\Request;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
/**
 * route::get - consultar
 * route::post - guardar
 * route::delete - eliminar
 * route::put - actualizar
 */
//                 //se llama la clase, metodo de la clase
// Route::get('/', [PageController::class, 'home'])->name('home');

// Route::get('blog', [PageController::class, 'blog'])->name('blog');
//     //return "blog";

//     // $posts = [
//     //     ['id' => 1, 'title' => 'PHP', 'slug' => 'php'],
//     //     ['id' => 2, 'title' => 'Laravel', 'slug' => 'laravel']
//     // ];
//     // return view('blog', ['posts' => $posts]);// De esta forma se envia a view la información obtenida.

// Route::get('blog/{slug}', [PageController::class, 'post'])->name('post');
// // Route::get('buscar', function ($request) {
// //     return $request->all;
// // });


/**
 * Mejor forma de escribir el codigo anterior
 */

 Route::controller(PageController::class)->group(function (){
    Route::get('/', 'home')->name('home');
    Route::get('blog/{post:slug}', 'post')->name('post');
 });


Route::redirect('/dashboard', 'posts')->name('dashboard');

Route::resource('posts', PostController::class)->middleware(['auth'])->except('show');

require __DIR__.'/auth.php';
