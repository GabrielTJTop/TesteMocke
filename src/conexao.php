<?php
class Conexao {
    public static function getConexao() {
        return new PDO('pgsql:host=localhost;dbname=teste_mocke', 'seu_usuario', 'sua_senha');
    }
}
