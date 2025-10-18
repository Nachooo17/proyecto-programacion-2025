<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        return Post::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'contenido' => 'required|string',
        ]);

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

    public function show($id)
    {
        return Post::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        if ($post->user_id !== Auth::id()) {
            return response()->json(['mensaje' => 'No autorizado.'], 403);
        }

        $request->validate([
            'titulo' => 'required|string|max:255',
            'contenido' => 'required|string',
        ]);

        $post->update($request->all());

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
