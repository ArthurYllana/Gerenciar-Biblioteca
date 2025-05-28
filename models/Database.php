<?php

class Database {
    private $host = '127.0.0.1';
    private $db_name = 'biblioteca';
    private $username = 'root';
    private $password = '';
    private $DBConn;
    private $charset = 'utf8mb4';

    public function __construct($servidor = '127.0.0.1', $nomeBanco = 'biblioteca', 
                               $usuario = 'root', $senha = '') {
        $this->host = $servidor;
        $this->db_name = $nomeBanco;
        $this->username = $usuario;
        $this->password = $senha;
        $this->createDatabase();
    }

    public function createDatabase() {
        try {
            $dsn = "mysql:host={$this->host};charset={$this->charset}";
            $this->DBConn = new PDO($dsn, $this->username, $this->password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);

            $this->DBConn->exec("CREATE DATABASE IF NOT EXISTS `{$this->db_name}` 
                                CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci");

            $this->DBConn = new PDO(
                "mysql:host={$this->host};dbname={$this->db_name};charset={$this->charset}",
                $this->username,
                $this->password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
        } catch (PDOException $e) {
            error_log("Erro ao criar o banco de dados: " . $e->getMessage());
            throw new Exception("Erro ao conectar-se ao banco de dados.");
        }
    }

    public function getConnection() {
        try {
            if ($this->DBConn === null) {
                $this->DBConn = new PDO(
                    "mysql:host={$this->host};dbname={$this->db_name};charset={$this->charset}",
                    $this->username,
                    $this->password,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                    ]
                );
            }
            return $this->DBConn;
        } catch (PDOException $e) {
            error_log("Erro ao conectar-se ao banco: " . $e->getMessage());
            throw new Exception("Falha na conexão. Por favor, tente novamente mais tarde.");
        }
    }
}
?>