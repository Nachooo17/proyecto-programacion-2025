<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todos los Posts</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .post { border:1px solid #ccc; padding:15px; margin-bottom:15px; border-radius:5px; }
        a.button { display:inline-block; padding:8px 15px; background-color:#28a745; color:white; text-decoration:none; border-radius:5px; margin-bottom:15px; }
    </style>
</head>
<body>

<h1>Todos los Posts</h1>
<a href="{{ route('posts.create') }}" class="button">Crear nuevo post</a>

@foreach ($posts as $post)
    <div class="post">
        <h3>{{ $post->titulo }}</h3>
        <p>{{ $post->contenido }}</p>
        <small>Autor: {{ $post->user->name }}</small>
    </div>
@endforeach

</body>
</html>

