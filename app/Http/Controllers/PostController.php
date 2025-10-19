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
        $post = Post::create([
            'titulo' => $request->titulo,
            'contenido' => $request->contenido,
            'user_id' => Auth::id(), 
        ]);

        return response()->json([
            'mensaje' => 'Post creado correctamente.',
            'post' => $post
        ], 201);
    }

    public function update(PostRequest $request, $id)
    {
        $post = Post::findOrFail($id);

        if ($post->user_id !== Auth::id()) {
            return response()->json(['mensaje' => 'No autorizado.'], 403);
        }

        $post->update([
            'titulo' => $request->titulo,
            'contenido' => $request->contenido,
        ]);

        return response()->json([
            'mensaje' => 'Post actualizado correctamente.',
            'post' => $post
        ]);
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if ($post->user_id !== Auth::id()) {
            return response()->json(['mensaje' => 'No autorizado.'], 403);
        }

        $post->delete();

        return response()->json(['mensaje' => 'Post eliminado correctamente.']);
    }
}
