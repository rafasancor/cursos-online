<?php
class CursoModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function create($nome, $descricao, $duracao, $preco) {
        $sql = "INSERT INTO cursos (nome, descricao, duracao, preco) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$nome, $descricao, $duracao, $preco]);
    }

    public function readAll() {
        $sql = "SELECT * FROM cursos WHERE status = 'ativo'";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($id, $nome, $descricao, $duracao, $preco) {
        $sql = "UPDATE cursos SET nome = ?, descricao = ?, duracao = ?, preco = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$nome, $descricao, $duracao, $preco, $id]);
    }

    public function delete($id) {
        $sql = "UPDATE cursos SET status = 'inativo' WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }
}
?>