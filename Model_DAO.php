<?php
require_once("/Sistema_e_LIXO_backend/Conexao_BD.php/Conexao.php");
require_once("/Sistema_e_LIXO_backend/Modelo/Modelo.php");
// Classes DAO para efetuar operações de CRUD no banco de dados.
class usuario_cliente_DAO extends Database_Conexao {
    private $conexao;
    private $tabela;
    private $campos;
    private $campos_id;
    private $campos_nome;
    private $campos_email;
    private $campos_senha;
    private $campos_cpf;
    private $campos_celular;
    private $campos_endereco;
    private $campos_numero;
    private $campos_bairro;
    private $campos_cidade;
    private $campos_estado;
    private $campos_cep;
    private $campos_data_nascimento;
    private $campos_data_cadastro;
    private $campos_data_atualizacao;
    private $campos_status;

    //Métodos  construtores
    public function __construct() {
        $this->conexao = new Database_Conexao(host: 'localhost', username: 'root', password: '', dbname: 'Sistema_e_LIXO');
        $this->tabela = "usuarios_cliente";
    }
        //Métodos de CRUD
        public function inserir($obj): mixed {
            $sql = "INSERT INTO $this->tabela (nome, email, senha, cpf
            celular, endereco, numero, bairro, cidade, estado, cep, data_nascimento,
            data_cadastro, data_atualizacao, status) VALUES (:nome, :email, :senha
            :cpf, :celular, :endereco, :numero, :bairro, :cidade,
            :estado, :cep, :data_nascimento, :data_cadastro, :data_atual
            :status)";
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":nome", $obj->getNome());
            $stmt->bindParam(":email", $obj->getEmail());
            $stmt->bindParam(":senha", $obj->getSenha());
            $stmt->bindParam(":cpf", $obj->getCpf());
            $stmt->bindParam(":celular", $obj->getCelular());
            $stmt->bindParam(":endereco", $obj->getEndereco());
            $stmt->bindParam(":numero", $obj->getNumero());
            $stmt->bindParam(":bairro", $obj->getBairro());
            $stmt->bindParam(":cidade", $obj->getCidade());
            $stmt->bindParam(":estado", $obj->getEstado());
            $stmt->bindParam(":cep", $obj->getCep());
            $stmt->bindParam(":data_nascimento", $obj->getDataNascimento());
            $stmt->bindParam(":data_cadastro", $obj->getDataCadastro());
            $stmt->bindParam(":data_atualizacao", $obj->getDataAtualizacao());
            $stmt->bindParam(":status", $obj->getStatus());
            $stmt->execute();
            return $this->conexao == true || $stmt == true ? true : false;
            }
            public function alterar($obj): void {
                $sql = "UPDATE $this->tabela SET nome = :nome, email = :
                senha = :senha, cpf = :cpf, celular = :celular, endereco = :
                numero = :numero, bairro = :bairro, cidade = :cidade, estado = :
                cep = :cep, data_nascimento = :data_nascimento, data_cadastro = :
                data_atualizacao = :data_atualizacao, status = :status WHERE id = :id";
                $stmt = $this->conexao->prepare($sql);
                $stmt->bindParam(":nome", $obj->getNome());
            }
            //Implemente os demais métodos abstratos dessa classe.
            public function excluir($id): void {
                $sql = "DELETE FROM $this->tabela WHERE id = :id";
                $stmt = $this->conexao->prepare($sql);
                $stmt->bindParam(":id", $id);
            }
            //Implemente os demais métodos abstratos dessa classe.
            public function buscarPorId($id): void {
                $sql = "SELECT * FROM $this->tabela WHERE id = :id";
                $stmt = $this->conexao->prepare($sql);
                $stmt->bindParam(":id", $id);
            }
            //Implemente os demais métodos abstratos dessa classe.
            public function buscarTodos(): void {
                $sql = "SELECT * FROM $this->tabela";
                $stmt = $this->conexao->prepare($sql);
            }
}

// __construct: Inicializa as variáveis de conexão com os parâmetros fornecidos.
// connect: Estabelece a conexão com o banco de dados e verifica se a conexão foi bem-sucedida.
// disconnect: Fecha a conexão com o banco de dados se estiver aberta.
// executeQuery: Executa uma consulta SQL e retorna o resultado. Se a consulta for uma instrução de modificação (INSERT, UPDATE, DELETE), retorna true. Para consultas SELECT, retorna o objeto de resultado.
// fetchAll: Chama executeQuery para executar uma consulta SELECT e retorna todos os resultados como um array associativo.
