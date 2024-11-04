<?php
    session_start();

    // print_r($_REQUEST);
    if(isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['senha'])){

        //Acesso ao sistema
        include_once("config.php");

        $email = $_POST['email'];
        $senha = $_POST['senha'];

        // print_r('Email: '.$email."<br>");
        // print_r('Senha: '.$senha);

        $sql = "SELECT * FROM pessoa WHERE email = '$email' and senha = '$senha'";

        $result = $conexao->query(query: $sql);

        // print_r($sql."<br>");
        // print_r($result);

        if(mysqli_num_rows(result: $result) < 1){
            echo "<script>Email ou senha inválidos.</script>";
            unset($_SESSION['email'] );
            unset($_SESSION['senha'] );

            header(header: "Location: Tela_login_e-LIXO_BlackBoxAi.php");
            // print_r("Não existe este cadastro no banco de dados.");
        }else{

            $_SESSION['email'] = $email;
            $_SESSION['senha'] = $senha;

            header(header: "Location: /Simple Responsive Website Using Html Css With Source Code/index.html");
            // print_r("Existe registro na base de dados.");
        }
    }else{
        //Não deixará acessar ao sistema
        header(header: "Location: Tela_login_e-LIXO_BlackBoxAi.php");
    }
