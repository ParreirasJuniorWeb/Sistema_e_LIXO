<?php
 session_start();
 if(isset($_POST['submit'])) {
 
 $identificacao = $_POST['identificacao'];
 $nome = $_POST['nome']  . " " . $_POST['ultimo_nome'];
 $email = $_POST['email'];
 $senha = $_POST['senha'];
 $cep = $_POST['cep'];
 $end = $_POST['endereco'];
 $tel = $_POST['telefone'];
 $data_nasc = $_POST['dataNascimento'];
 $identificacao_user = random_int(min: 1000, max: 9999);
 
 include_once("config.php");

 $result_1 = mysqli_query(mysql: $conexao, query: "INSERT INTO pessoa (identificacao, nome, email, endereco, telefone, data_nascimento, senha) VALUES ('$identificacao', '$nome', '$email', '$endereco', '$telefone', '$data_nascimento', $senha')");
 $result_1 = mysqli_query(mysql: $conexao, query: "INSERT INTO usuario_cliente (identificacao, idPessoa) VALUES ('$identificacao_user', '$identificacao')");

 if($result == true){
  echo "<p>Cadastrado com sucesso!<p>";
  echo "<scritp>Usuário criado com sucesso.</scritp>";
  header(header: "Tela_login_e-LIXO_BlackBoxAi.html");
}else {
  echo "<p>Não foi possível cadastrá-lo.<p>";
  echo "<scritp>Erro ao criar usuário.</scritp>";
}
$session_email = $_SESSION['email'];
$session_senha = $_SESSION['senha'];
}
