<?php
$nome = $_POST['nome'];
$email = $_POST['email'];
$cep = $_POST['cep'];
$endereco = $_POST['endereco'];
$telefoneFixo = $_POST['telefone'];
$data = $_POST['data'];
$time = $_POST['hora'];
$tipoMaterial = $_POST['tipoMaterial'];
$tipoPontoColeta = $_POST['tipoPontoColeta'];
$tipoDescarte = $_POST['tipoDescarte'];
$foto = $_POST['foto'];
$subject = $_POST['subject'];
$msg = $_POST['msg'];

// Classes de Controle de Requisição e Resposta do navegador em PHP
require_once("Model/Model.php");

class Request {
    private $identificacao_user, $session_email, $session_senha, $nome, $email, $telefone, $endereco, $cep, $data, $time, $tipoMaterial, $tipoPontoColeta, $tipoDescarte,  $foto, $subject, $msg;

    public function __construct($identificacao_user, $session_email, $session_senha, $nome, $email, $telefone, $endereco, $cep, $data, $time, $tipoMaterial, $tipoPontoColeta, $tipoDescarte,  $foto, $subject, $msg){
        $this->identificacao = $identificacao_user;
        $this->session_email = $session_email;
        $this->session_senha = $session_senha;
        $this->nome = $nome;
        $this->email = $email;
        $this->telefone = $telefone;
        $this->endereco = $endereco;
        $this->cep = $cep;
        $this->data = $data;
        $this->time = $time;
        $this->tipoMaterial = $tipoMaterial;
        $this->tipoPontoColeta = $tipoPontoColeta;
        $this->tipoDescarte = $tipoDescarte;
        $this->foto = $foto;
        $this->subject = $subject;
        $this->msg = $msg;
    }
    public function registrarAgendamento($nomeIntegrantes_equipe, $info_usuario, $info_coleta, $status_coleta): void {  // Um objeto da classe Usuário_cliente // Um objeto da classe de ColetaDomiciliar_Amb_Trab // Status da coleta
        $identificacao_coleta = random_int(min: 1000, max: 9999);
        $agendamento = new Agendamento_coleta($identificacao_coleta, $this->data, $this->time, $this->endereco, $this->cep, $this->telefone, $nomeIntegrantes_equipe, $info_usuario, $info_coleta, $status_coleta);
        $reserva = $this->data + $this->time;
        $this->session_email = $this->email;
        $idEquipe = random_int(1000, 9999);
        $idRelatorio = random_int(1000, 9999);
        $agendamento->salvarAgendamento(identificacao_coleta: $identificacao_coleta, data: $this->data, time: $this->time, reserva: $reserva, nomeIntegrantes_equipe: $nomeIntegrantes_equipe, status_coleta: $status_coleta, idUsuario: $this->identificacao_user, idEquipe: $idEquipe, idRelatorio: $idRelatorio);
    }
}