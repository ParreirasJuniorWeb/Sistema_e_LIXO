<?php
require_once("Conexao_BD.php/Conexao.php");
require_once("Model/Model.php");

// Classes DAO para efetuar operações de CRUD no banco de dados.
class Item_Registro_DAO extends Database_Conexao
{
    public function __construct($host, $username, $password, $dbname){
        parent::__construct(host: $host, username: $username, password: $password, dbname: $dbname);
    }

    //Método para executar uma consulta SQL
    //Métodos de CRUD
    public function executeQuery($sql): bool|mysqli_result
    {
        $result = $this->conn->query(query: $sql);

        // Verifica se a consulta foi bem-sucedida
        if ($result === TRUE) {
            return true;
        } elseif ($result) {
            return $result; // Retorna o resultado se for uma consulta SELECT
        } else {
            echo "Error: " . $this->conn->error;
            return false;
        }
    }

    // Método para obter resultados de uma consulta SELECT
    public function fetchAll($sql): array
    {
        $result = $this->executeQuery(sql: $sql);
        $data = [];

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }

        return $data;
    } 
}

//Exemplo de uso
$db = new Item_Registro_DAO(host: 'localhost', username: 'root', password: '886744@Jo', dbname: 'e_lixo_system');
$db->connect();
$results = $db->fetchAll(sql: "SELECT * FROM registro_item");
print_r(value: $results);
$db->disconnect();

// Explicação dos métodos:

// executeQuery: Executa uma consulta SQL e retorna o resultado. Se a consulta for uma instrução de modificação (INSERT, UPDATE, DELETE), retorna true. Para consultas SELECT, retorna o objeto de resultado.
// fetchAll: Chama executeQuery para executar uma consulta SELECT e retorna todos os resultados como um array associativo.