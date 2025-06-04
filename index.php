<?php
session_start();
require_once 'config/database.php';
require_once 'controllers/CursoController.php';
require_once 'controllers/AuthController.php';

$pdo = (new Database())->connect();
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($uri === '/') {
    require 'views/public/home.php';
} elseif ($uri === '/cursos') {
    $cursoController = new CursoController($pdo);
    $cursoController->index();
} elseif ($uri === '/login') {
    $authController = new AuthController($pdo);
    $authController->login();
} elseif ($uri === '/admin/cursos/create') {
    if (!isset($_SESSION['user_id'])) {
        header('Location: /login');
        exit;
    }
    $cursoController = new CursoController($pdo);
    $cursoController->create();
} else {
    echo "404 - Página não encontrada";
}
?>