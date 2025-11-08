<?php
use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../src/UsuarioRepository.php';

class UsuarioRepositoryTest extends TestCase
{
    private $pdo;
    private $repo;

    protected function setUp(): void
    {
        // 🔹 Conecta ao banco real (PostgreSQL)
        $this->pdo = new PDO('pgsql:host=localhost;dbname=teste_mocke', 'postgres', 'root');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // 🔹 Limpa a tabela antes de cada teste
        $this->pdo->exec("TRUNCATE TABLE usuarios RESTART IDENTITY CASCADE");

        // 🔹 Cria o repositório
        $this->repo = new UsuarioRepository($this->pdo);
    }

    public function testSalvarUsuarioNoBanco()
    {
        // 🔹 Executa o método que salva
        $resultado = $this->repo->salvarUsuario('Maria Eduarda');

        // 🔹 Verifica se salvou com sucesso
        $this->assertTrue($resultado);

        // 🔹 Busca os dados direto no banco pra confirmar
        $usuarios = $this->repo->listarUsuarios();

        $this->assertCount(1, $usuarios);
        $this->assertEquals('Maria Eduarda', $usuarios[0]['nome']);
    }
}
