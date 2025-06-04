<?php
require_once 'models/CursoModel.php';

class CursoController {
    private $cursoModel;

    public function __construct($pdo) {
        $this->cursoModel = new CursoModel($pdo);
    }

    public function index() {
        $cursos = $this->cursoModel->readAll();
        require 'views/public/cursos.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->validateCsrfToken();
            $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
            $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING);
            $duracao = filter_input(INPUT_POST, 'duracao', FILTER_SANITIZE_NUMBER_INT);
            $preco = filter_input(INPUT_POST, 'preco', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

            if ($nome && $duracao && $preco) {
                $this->cursoModel->create($nome, $descricao, $duracao, $preco);
                header('Location: /admin/cursos');
            }
        }
        require 'views/admin/cursos/cadastro.php';
    }

    private function validateCsrfToken() {
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            die('CSRF token inválido.');
        }
    }
}
?>