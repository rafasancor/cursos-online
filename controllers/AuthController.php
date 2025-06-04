<?php
require_once 'models/AlunoModel.php';

class AuthController {
    private $alunoModel;

    public function __construct($pdo) {
        $this->alunoModel = new AlunoModel($pdo);
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->validateCsrfToken();
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $senha = $_POST['senha'];
            $aluno = $this->alunoModel->findByEmail($email);

            if ($aluno && password_verify($senha, $aluno['senha'])) {
                session_regenerate_id(true);
                $_SESSION['user_id'] = $aluno['id'];
                if (isset($_POST['lembrar'])) {
                    setcookie('user_email', $email, time() + 86400 * 30, '/', '', true, true);
                }
                header('Location: /admin');
            } else {
                echo "Credenciais inválidas.";
            }
        }
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        require 'views/auth/login.php';
    }

    public function recoverPassword() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->validateCsrfToken();
            $cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_STRING);
            $data_nascimento = filter_input(INPUT_POST, 'data_nascimento', FILTER_SANITIZE_STRING);
            $aluno = $this->alunoModel->findByCpfAndBirthdate($cpf, $data_nascimento);

            if ($aluno) {
                // Simula envio de link temporário (em produção, use e-mail)
                echo "Link de recuperação enviado para {$aluno['email']}";
            } else {
                echo "CPF ou data de nascimento inválidos.";
            }
        }
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        require 'views/auth/recuperar_senha.php';
    }

    private function validateCsrfToken() {
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            die('CSRF token inválido.');
        }
    }
}
?>