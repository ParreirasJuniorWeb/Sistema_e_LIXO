<?php
//Gere um código em PHP Orientado a Objetos para o envio de um e-mail com o campos de Nome, E-mail, Subject, Mensagem e Anexo.
// Inclua o autoload do Composer
require 'vendor/autoload.php'; // Altere o caminho se necessário

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class EmailSender {
    private $nome;
    private $email;
    private $assunto;
    private $mensagem;
    private $anexo;
    public function __construct($nome, $email, $assunto, $mensagem, $anexo) {
        $this->nome = $nome;
        $this->email = $email;
        $this->assunto = $assunto;
        $this->mensagem = $mensagem;
        $this->anexo = $anexo;
        }
        public function getNome(): mixed {
            return $this->nome;
        }
        public function getEmail(): mixed {
            return $this->email;
        }
        public function getAssunto(): mixed {
            return $this->assunto;
        }
        public function getMensagem(): mixed {
            return $this->mensagem;
        }
        public function getAnexo(): mixed {
            return $this->anexo;
        }
        //Pode  ser necessário adicionar mais métodos para configurar o SMTP
        public function sendEmail(): void {
        // Aqui você pode usar a biblioteca PHPMailer para enviar o e-mail
        $mail = new PHPMailer(true); // Cria uma nova instância do PHPMailer
        try {
            try {
            // Configurações do servidor SMTP
            $mail->isSMTP(); // Define que usaremos SMTP
            $mail->Host = 'smtp.gmail.com'; // Endereço do servidor SMTP
            $mail->SMTPAuth = true; // Habilita autenticação SMTP
            $mail->Username = 'joaoparreiras2020@gmail.com'; // Seu usuário SMTP
            $mail->Password = 'DeLux02040#MF/PaRrE!R@Zs\S.O***'; // Sua senha SMTP
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Habilita criptografia TLS
            $mail->Port = 465; // Porta TCP para conexão
        
            // Testa a conexão
            $mail->smtpConnect();
            echo 'Conexão SMTP bem-sucedida!';
            $mail->smtpClose();
        } catch (Exception $e) {
            echo "Erro ao conectar ao SMTP: {$mail->ErrorInfo}";
        }
            // Remetente e destinatário
            $mail->setFrom($this->getEmail(), $this->getNome());
            $mail->addAddress('joaoparreiras2020@gmail.com', 'João Victor Parreiras'); // Adiciona um destinatário
        
            // Conteúdo do e-mail
            $mail->isHTML(true); // Define o formato do e-mail como HTML
            $mail->Subject = $this->getAssunto();
            $mail->Body    = $this->getMensagem();
            $mail->AltBody = $this->getMensagem();
        
            // Envia o e-mail
            $mail->send();
            echo 'E-mail enviado com sucesso!';
        } catch (Exception $e) {
            echo "O e-mail não pôde ser enviado. Erro do PHPMailer: {$mail->ErrorInfo}";
        }
    }
}
$nome = $_POST['nome'];
$email = $_POST['email'];
$assunto = $_POST['assunto'];
$mensagem = $_POST['mensagem'];
$anexo = $_POST['anexo'];

$email_send = new EmailSender($nome, $email, $assunto, $mensagem, $anexo);
if(isset($_POST['submit']) && $nome != null && $email != null && $assunto != null && $mensagem != null && $anexo != null) {
    $email_send->sendEmail();
}