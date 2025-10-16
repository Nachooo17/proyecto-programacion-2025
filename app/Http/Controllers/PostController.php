<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        return Post::all();
    }

    public function show($id)
    {
        return Post::findOrFail($id);
    }

    public function store(PostRequest $request)
    {
        $post = new Post();
        $post->titulo = $request->titulo;
        $post->contenido = $request->contenido;
        $post->user_id = Auth::id();
        $post->save();

        return response()->json($post, 201);
    }

    public function update(PostRequest $request, $id)
    {
        $post = Post::findOrFail($id);

        if ($post->user_id != Auth::id()) {
            return response()->json(['error' => 'No autorizado'], 403);
        }

        $post->titulo = $request->titulo;
        $post->contenido = $request->contenido;
        $post->save();

        return response()->json($post);
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if ($post->user_id != Auth::id()) {
            return response()->json(['error' => 'No autorizado'], 403);
        }

        $post->delete();

        return response()->json(['mensaje' => 'Post eliminado']);
    }
}
