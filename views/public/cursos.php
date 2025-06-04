<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cursos Disponíveis</title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
    <header>
        <h1>Cursos Disponíveis</h1>
        <nav>
            <a href="/">Home</a> | <a href="/sobre">Sobre Nós</a> | <a href="/login">Login</a>
        </nav>
    </header>
    <main>
        <section>
            <h2>Nossos Cursos</h2>
            <?php foreach ($cursos as $curso): ?>
                <article>
                    <h3><?php echo htmlspecialchars($curso['nome']); ?></h3>
                    <p><?php echo htmlspecialchars($curso['descricao']); ?></p>
                    <p>Duração: <?php echo $curso['duracao']; ?> horas</p>
                    <p>Preço: R$ <?php echo number_format($curso['preco'], 2, ',', '.'); ?></p>
                    <p>Alunos matriculados: <?php echo $curso['total_alunos'] ?? 0; ?></p>
                </article>
            <?php endforeach; ?>
        </section>
    </main>
    <footer>
        <p>&copy; 2025 Plataforma de Cursos Online</p>
    </footer>
</body>
</html>