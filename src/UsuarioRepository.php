<?php

class UsuarioRepository
{
    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function salvarUsuario(string $nome): bool
    {
        $stmt = $this->pdo->prepare("INSERT INTO usuarios (nome) VALUES (:nome)");
        return $stmt->execute(['nome' => $nome]);
    }

    public function listarUsuarios(): array
    {
        return $this->pdo->query("SELECT * FROM usuarios")->fetchAll();
    }
}
