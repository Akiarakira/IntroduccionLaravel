<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
Use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    public function index() {
        return view('posts.index', [
            'posts' => Post::latest()->paginate()
        ]);
    }

    public function create(Post $post) {
        return view('posts.create', ['post'=>$post]);
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:posts,slug',
            'body' => 'required',
        ]);
        $post = $request->user()->posts()->create([
            'title' => $request->title,
            'slug' => $request->slug,
            'body' => $request->body
        ]);
        return redirect()->route('posts.edit', $post);
    }
 
    public function edit(Post $post) {
        return view('posts.edit', ['post'=>$post]);
    }

    public function update(Request $request, Post $post) {
        $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:posts,slug->ignore($post->id)',// el $post->id se coloca para que la validacion ignore el registro con el que se esta trabajando actualmente
            'body' => 'required',
        ]);
        $post->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'body' => $request->body
        ]);
        return redirect()->route('posts.edit', $post);
    }

    public function destroy(Post $post) {
        $post->delete();
        return back();
    }
}
