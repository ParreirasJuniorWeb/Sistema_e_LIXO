<?php 
// Classes de Controle de Requisição e Resposta do navegador em PHP
require_once("Model/Model.php");

class Request {
    private $session_email, $session_senha, $identificacao, $nome, $email, $senha, $confirma_senha, $telefone, $endereco, $cep, $data_nascimento, $url;
    public function __construct($session_email, $session_senha, $identificacao, $nome, $email, $senha, $confirma_senha, $telefone, $endereco, $cep, $data_nascimento, $url){
        $this->session_email = $session_email;
        $this->session_senha = $session_senha;
        $this->identificacao = $identificacao;
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
        $this->confirma_senha = $confirma_senha;
        $this->telefone = $telefone;
        $this->endereco = $endereco;
        $this->cep = $cep;
        $this->data_nascimento = $data_nascimento;
        $this->url = $url;
    }
    public function login($session_email, $session_senha, $email, $senha, $identificacao_user, $nome, $endereco, $telefone, $data_nascimento): void {
    // Check if the user is logged in
    if (isset($session_email) && !empty($session_email) && isset($session_senha) && !empty($session_senha)) {
        $email = $_POST['email'];
        $senha = $_POST['senha'];
    // If the user is logged in, redirect them to the home
    header(header: '/Simple Responsive Website Using Html Css With Source Code/' + $this->url);
    } else {
        unset($_SESSION['email'] );
        unset($_SESSION['senha'] );
        $identificacao_user = random_int(min: 1000, max: 9999);
        // If the user is not logged in, fazer a conexão com o  banco de dados
        $db = new Usuario_cliente(identificacao_user: $identificacao_user, nome: $nome, email: $email, endereco: $endereco, telefone: $telefone, data_nascimento: $data_nascimento, senha: $senha);
        $db->login(email: $email, senha: $senha);
        if($db){
            echo "Login realizado com sucesso.";
            $_SESSION['email'] = $email;
            $_SESSION['senha'] = $senha;
            header(header: "/Simple Responsive Website Using Html Css With Source Code/" + $this->url);
            } else {
                echo "Login inválido.";
                header(header: "/WebPages_eLixo_frontend/Tela_login_e-LIXO_BlackBoxAi.html");
            }
        }
    }

    public  function cadastrar($session_email, $session_senha, $identificacao, $nome, $email, $senha, $confirma_senha, $telefone, $endereco, $cep, $data_nascimento): void {

        // Check if the user is logged in
        if (isset($session_email) && !empty($session_email) && isset($session_senha) && !empty($session_senha)) {
            $email = $_POST['email'];
            $senha = $_POST['senha'];
            // If the user is logged in, redirect them to the home
            header(header: '/Simple Responsive Website Using Html Css With Source Code/' + $this->url);
        } else {
            $identificacao_user = random_int(min: 1000, max: 9999);
            // Estabelecer a conexão com o banco de dados
            $db = new Usuario_cliente($identificacao_user, $nome, $email, $endereco, $telefone, $data_nascimento, $senha);
            $db->registrar($identificacao_user, $nome, $endereco, $telefone, $data_nascimento, $senha, $email);
            if($db){
                echo "\nJá existe um usuário com esse e-mail.";
                unset($_SESSION['email'] );
                unset($_SESSION['senha'] );
            } else {
                if (($senha == $confirma_senha) &&  (isset($_POST['submit']))) {
                $db = new Pessoa_DAO(host: 'localhost', username: 'root', password:'886744@Jo', dbname: 'e_lixo_system');
                $db->connect();
                $db->executeQuery(sql: "INSERT INTO pessoa (identificacao, nome, email, endereco, telefone, data_nascimento, senha) VALUES ('$identificacao', '$nome', '$email', '$endereco', '$telefone', '$data_nascimento', $senha')");
                $db->executeQuery(sql: "INSERT INTO usuario_cliente (identificacao, idPessoa) VALUES ('$identificacao_user', '$identificacao')");
                $db->disconnect();
                echo "Usuário criado com sucesso.";
                $email = $_POST['email'];
                $senha = $_POST['senha'];
                header(header: "/WebPages_eLixo_frontend/Tela_login_e-LIXO_BlackBoxAi.html");
            }}
        }
    }
}

$session_email = $_SESSION['email'];
 $session_senha = $_SESSION['senha'];
 
 $identificacao = $_POST['identificacao'];
 $nome = $_POST['nome']  . " " . $_POST['ultimo_nome'];
 $email = $_POST['email'];
 $senha = $_POST['senha'];
 $c_senha = $_POST['confirma-senha'];
 $tel = $_POST['telefone'];
 $end = $_POST['endereco'];
 $cep = $_POST['cep'];
 $data_nasc = $_POST['dataNascimento'];

if(isset($_POST['submit'])) {
$req = new Request($session_email, $session_senha, $identificacao, $nome, $email, $senha, $c_senha, $tel, $end, $cep, $data_nasc, $url = "index.html");

$req->login(session_email: $session_email, session_senha: $session_senha, email: $email, senha: $senha, identificacao_user: $identificacao_user, nome: $nome, endereco: $end, telefone: $tel, data_nascimento: $data_nasc);
$req->cadastrar(session_email: $session_email, session_senha: $session_senha, identificacao: $identificacao, nome: $nome, email: $email, senha: $senha, confirma_senha: $c_senha, telefone: $tel, endereco: $end, cep: $cep, data_nascimento: $data_nasc);

if($session_email.include('@eLixo_equip')){
    $req = new Request($session_email, $session_senha, $identificacao, $nome, $email, $senha, $c_senha, $tel, $end, $cep, $data_nasc, $url = "Services_equipe_coleta_eLixo.html");
    $req->login(session_email: $session_email, session_senha: $session_senha, email: $email, senha: $senha, identificacao_user: $identificacao_user, nome: $nome, endereco: $end, telefone: $tel, data_nascimento: $data_nasc);
    $req->cadastrar(session_email: $session_email, session_senha: $session_senha, identificacao: $identificacao, nome: $nome, email: $email, senha: $senha, confirma_senha: $c_senha, telefone: $tel, endereco: $end, cep: $cep, data_nascimento: $data_nasc);
}

if($session_email.include('@eLixo_admin')){
    $req = new Request($session_email, $session_senha, $identificacao, $nome, $email, $senha, $c_senha, $tel, $end, $cep, $data_nasc, $url = "Services_admin.html");
    $req->login(session_email: $session_email, session_senha: $session_senha, email: $email, senha: $senha, identificacao_user: $identificacao_user, nome: $nome, endereco: $end, telefone: $tel, data_nascimento: $data_nasc);
    $req->cadastrar(session_email: $session_email, session_senha: $session_senha, identificacao: $identificacao, nome: $nome, email: $email, senha: $senha, confirma_senha: $c_senha, telefone: $tel, endereco: $end, cep: $cep, data_nascimento: $data_nasc);
}

if($session_email.include('@eLixo_fiscal')){
    $req = new Request($session_email, $session_senha, $identificacao, $nome, $email, $senha, $c_senha, $tel, $end, $cep, $data_nasc, $url = "Services_fiscal.html");
    $req->login(session_email: $session_email, session_senha: $session_senha, email: $email, senha: $senha, identificacao_user: $identificacao_user, nome: $nome, endereco: $end, telefone: $tel, data_nascimento: $data_nasc);
    $req->cadastrar(session_email: $session_email, session_senha: $session_senha, identificacao: $identificacao, nome: $nome, email: $email, senha: $senha, confirma_senha: $c_senha, telefone: $tel, endereco: $end, cep: $cep, data_nascimento: $data_nasc);
}}