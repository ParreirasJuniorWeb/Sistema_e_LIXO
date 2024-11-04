<?php
// Código em PHP para realizar a conexão com o Banco de dados MySQL - classe Conexão com BD.
class Database_Conexao
{
    private $host;
    private $username;
    private $password;
    private $dbname;
    protected $conn;

    public function __construct($host, $username, $password, $dbname)
    {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
    }

    // Método para conectar ao banco de dados
    public function connect(): void
    {
        $this->conn = new mysqli(hostname: $this->host, username: $this->username, password: $this->password, database: $this->dbname);

        // Verifica se houve erro na conexão
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
        echo "Connected successfully";
    }

    // Método para desconectar do banco de dados
    public function disconnect(): void
    {
        if ($this->conn) {
            $this->conn->close();
            echo "Disconnected successfully";
        }
    }
}
// Explicação dos métodos:

// __construct: Inicializa as variáveis de conexão com os parâmetros fornecidos.
// connect: Estabelece a conexão com o banco de dados e verifica se a conexão foi bem-sucedida.
// disconnect: Fecha a conexão com o banco de dados se estiver aberta.