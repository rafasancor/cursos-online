<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
    <header>
        <h1>Login</h1>
        <nav>
            <a href="/cadastro">Cadastrar</a> | <a href="/recuperar-senha">Recuperar Senha</a>
        </nav>
    </header>
    <main>
        <form method="POST" action="/login">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            <label>E-mail:</label>
            <input type="email" name="email" required>
            <label>Senha:</label>
            <input type="password" name="senha" required>
            <label><input type="checkbox" name="lembrar"> Lembrar-me</label>
            <button type="submit">Entrar</button>
        </form>
    </main>
    <footer>
        <p>&copy; 2025 Plataforma de Cursos Online</p>
    </footer>
</body>
</html>