<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Post</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        form { max-width: 500px; }
        div.form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input[type="text"], textarea { width: 100%; padding: 8px; box-sizing: border-box; }
        button { padding: 8px 15px; background-color: #007bff; color: white; border: none; border-radius:5px; cursor:pointer; }
    </style>
</head>
<body>

<h1>Crear Post</h1>

<form action="{{ route('posts.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" required>
    </div>
    <div class="form-group">
        <label for="contenido">Contenido:</label>
        <textarea id="contenido" name="contenido" required rows="6"></textarea>
    </div>
    <button type="submit">Crear</button>
</form>

</body>
</html>
