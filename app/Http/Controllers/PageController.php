<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home(Request $request)
    {
        $search = $request->search;

        $posts = Post::where('title', 'LIKE', "%{$search}%")
            ->with('user')
            ->latest()->paginate();
        return view('home', ['posts' => $posts]);
    }

    public function post(Post $post)
    {

        return view('post', ['post' => $post]);
    }
}


    // public function blog()
    // {
    //     /**Forma sin eloquent: */
    //     // $posts = [
    //     //     ['id' => 1, 'title' => 'PHP', 'slug' => 'php'],
    //     //     ['id' => 2, 'title' => 'Laravel', 'slug' => 'laravel']
    //     // ];

    //     /** forma con Eloquent (No requere de sentencia sql): */
    //     // $posts = Post::get(); //obtiene todos los registros de la DB.
    //     // $posts = Post::first(); //Trae el primer registro de la DB.
    //     // $posts = Post::find(); //Trae un registro de la DB por medio de su ID.

    //     $posts = Post::latest()->paginate();
    //     return view('blog', ['posts' => $posts]); // De esta forma se envia a view la información obtenida.
    // }