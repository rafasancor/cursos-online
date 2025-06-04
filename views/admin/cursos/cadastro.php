<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Curso</title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
    <header>
        <h1>Cadastro de Curso</h1>
        <nav>
            <a href="/admin/cursos">Voltar</a>
        </nav>
    </header>
    <main>
        <form method="POST" action="/admin/cursos/create">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            <label>Nome:</label>
            <input type="text" name="nome" required>
            <label>Descrição:</label>
            <textarea name="descricao"></textarea>
            <label>Duração (horas):</label>
            <input type="number" name="duracao" required>
            <label>Preço:</label>
            <input type="number" step="0.01" name="preco" required>
            <button type="submit">Cadastrar</button>
        </form>
    </main>
    <footer>
        <p>&copy; 2025 Plataforma de Cursos Online</p>
    </footer>
</body>
</html>