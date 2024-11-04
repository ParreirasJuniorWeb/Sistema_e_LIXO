<?php
require_once("../Model_DAO/Cliente_DAO.php");
require_once("../Model_DAO/Agendamento_DAO.php");
require_once("../Model_DAO/Relatorio_DAO.php");
// Classes em PHP do Diagrama de Classes Usuário Cliente
// Interações entre as ações do cliente e a Equipe de Coleta de Lixo eletrônico.
require 'vendor/autoload.php'; // Carregar o autoloader do Composer

use GuzzleHttp\Client;

require 'vendor/autoload.php'; // Certifique-se de que o autoload do Composer está incluído
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

abstract class Pessoa
{
    private $identificacao;
    private $nome;
    private $email;
    private $endereco;
    private  $telefone;
    private $data_nascimento;
    private $senha;

    // Métodos da classe Pessoa
    public function __construct($identificacao, $nome, $email, $endereco, $telefone, $data_nascimento, $senha)
    {

        $this->identificacao = $identificacao;
        $this->nome = $nome;
        $this->email = $email;
        $this->endereco = $endereco;
        $this->telefone = $telefone;
        $this->data_nascimento = $data_nascimento;
        $this->senha = $senha;
    }

    //Métodos  Getters e Setters
    public function getIdentificacao(): mixed
    {
        return $this->identificacao;
    }
    public function setIdentificacao($identificacao): void
    {
        $this->identificacao = $identificacao;
    }
    public function getNome(): mixed
    {
        return $this->nome;
    }
    public function setNome($nome): void
    {
        $this->nome = $nome;
    }
    public function getEmail(): mixed
    {
        return $this->email;
    }
    public function setEmail($email): void
    {
        $this->email = $email;
    }
    public function getEndereco(): mixed
    {
        return $this->endereco;
    }
    public function setEndereco($endereco): void
    {
        $this->endereco = $endereco;
    }
    public function getTelefone(): mixed
    {
        return $this->telefone;
    }
    public function setTelefone($telefone): void
    {
        $this->telefone = $telefone;
    }
    public function getData_nascimento(): mixed
    {
        return $this->data_nascimento;
    }
    public function setData_nascimento($data_nascimento): void
    {
        $this->data_nascimento = $data_nascimento;
    }
    public function getSenha(): mixed
    {
        return $this->senha;
    }
    public function setSenha($senha): void
    {
        $this->senha = $senha;
    }

    protected function atualizarIdade($idade): int
    {
        //Cálculo para obter a idade de uma pessoa a partir da sua data de nascimento e retornar o valor.
        $data_atual = new DateTime();
        $idade = $data_atual->diff(targetObject: $this->data_nascimento);
        return $idade->y;
    }

    protected function login($email, $senha): void
    {
        //Implementação do método de login.
        //Verificar se o usuário existe e se a senha está correta.
        if ($email == $this->getIdentificacao() && $senha == $this->getSenha()) {
            $db = new Pessoa_DAO(host: 'localhost', username: 'root', password: '', dbname: '');
            $db->connect();
            $results = $db->fetchAll(sql: "SELECT * FROM pessoa WHERE email = '$email' AND  senha = '$senha'");
            $db->disconnect();
            if ($results !== null) {
                echo "Login realizado com sucesso.";
                header(header: "/Simple Responsive Website Using Html Css With Source Code/index.html");
            } else {
                echo "Login inválido.";
                header(header: "/WebPages_eLixo_frontend/Tela_login_e-LIXO_BlackBoxAi.html");
            }
        }
    }
    protected function registrar($identificacao_user, $nome, $endereco, $telefone, $data_nascimento, $senha, $email): void
    {
        $identificacao_user = random_int(1000, 9999);
        //Implementação do método de registro de um usuário.
        //Verificar se o usuário já existe.
        $db = new Pessoa_DAO(host: 'localhost', username: 'root', password: '', dbname: '');
        $db->connect();
        $results = $db->fetchAll(sql: "SELECT * FROM pessoa WHERE email = '$email' AND  senha = '$senha'");
        $db->disconnect();
        if ($results !== null) {
            echo "\nJá existe um usuário com esse e-mail.";
        } else {
            $db = new Pessoa_DAO(host: 'localhost', username: 'root', password: '', dbname: '');
            $db->connect();
            $db->executeQuery(sql: "INSERT INTO pessoa (identificacao, nome, email, endereco, telefone, data_nascimento, senha) VALUES ('$identificacao_user', '$nome', '$email', '$endereco', '$telefone', '$data_nascimento', $senha')");
            $db->disconnect();
            echo "Usuário criado com sucesso.";
            header(header: "/WebPages_eLixo_frontend/Tela_login_e-LIXO_BlackBoxAi.html");
        }
    }
}

//------------------FIM DA CLASSE PESSOA----------------//

class Usuario_cliente  extends Pessoa
{
    private $identificacao_user;
    private $senha;

    //Métodos
    public function getIdentificacao_user(): mixed
    {
        return $this->identificacao_user;
    }
    public function setIdentificacao_user($identificacao_user): void
    {
        $this->identificacao_user = $identificacao_user;
    }
    public function getSenha(): mixed
    {
        return $this->senha;
    }
    public function setSenha($senha): void
    {
        $this->senha = $senha;
    }

    //Método Construtor dessa classe e da classe mãe
    public function __construct($identificacao_user, $nome, $email, $endereco, $telefone, $data_nascimento, $senha)
    {
        parent::__construct(identificacao: $identificacao_user, nome: $nome, email: $email, endereco: $endereco, telefone: $telefone, data_nascimento: $data_nascimento,  senha: $senha);


        $this->identificacao_user = $identificacao_user;
        $this->senha = $senha;
    }

    //Obter os métodos login, logout e registrar da classe mãe.
    public function login($email, $senha): void
    {
        parent::login(email: $email, senha: $senha);
    }
    public function registrar($identificacao_user, $nome, $email, $endereco, $telefone, $data_nascimento, $senha): void

    {
        parent::registrar(identificacao_user: $identificacao_user, nome: $nome, endereco: $email, telefone: $endereco, data_nascimento: $telefone, senha: $data_nascimento, email: $senha);
    }
    public function agendarColeta(): void
    {
        //Implementação do método de agendamento de coleta.
    }
    public function  cancelarColeta(): void
    {
        //Implementação do método de cancelamento de coleta.
    }
    public function  verificarColeta(): void
    {
        //Implementação do método de verificação de coleta.
    }
    public function   verificarStatusColeta(): void
    {
        //Implementação do método de verificação do status da coleta.
    }
    public function visualizarHistoricoColetas(): void
    {
        //Implementação do método de visualizar o histórico de coletas do cliente.
    }
}

//------------------FIM DA CLASSE USUÁRIO CLIENTE----------------//

// Classe ColetaLixoEletrônico
class ColetaDomiciliar_Amb_Trab
{
    private $identificacao_coleta;
    private $Dados_relatorio;
    private $status_coleta;
    private $data_coleta;
    private $hora_coleta;
    private $enderecoColeta;
    private $CEP;
    private $telefone_equipe_resp;
    private $nome_equipe_resp;
    private $capacidadeMaxima;  //Capacidade máxima de lixo eletrônico que a coleta pode realizar.
    private $tipoLixo;
    private $quantidade;
    private $valorTotal;

    //Métodos construtores.
    public function __construct($identificacao_coleta, $Dados_relatorio, $status_coleta, $data_coleta, $hora_coleta, $enderecoColeta, $CEP, $telefone_equipe_resp, $nome_equipe_resp, $capacidadeMaxima, $tipoLixo, $quantidade, $valorTotal)
    {

        $this->identificacao_coleta = $identificacao_coleta;
        $this->Dados_relatorio = $Dados_relatorio;
        $this->status_coleta = $status_coleta;
        $this->data_coleta = $data_coleta;
        $this->hora_coleta = $hora_coleta;
        $this->enderecoColeta = $enderecoColeta;
        $this->CEP = $CEP;
        $this->telefone_equipe_resp = $telefone_equipe_resp;
        $this->nome_equipe_resp = $nome_equipe_resp;
        $this->capacidadeMaxima = $capacidadeMaxima;
        $this->tipoLixo = $tipoLixo;
        $this->quantidade = $quantidade;
        $this->valorTotal = $valorTotal;
    }
    //Métodos de acesso.
    public function getIdentificacaoColeta(): int
    {
        return $this->identificacao_coleta;
    }
    public function getDadosRelatorio(): string
    {
        return $this->Dados_relatorio;
    }
    public function getStatusColeta(): string
    {
        return $this->status_coleta;
    }
    public function getDataColeta(): string
    {
        return $this->data_coleta;
    }
    public function getHoraColeta(): string
    {
        return $this->hora_coleta;
    }
    public function getEnderecoColeta(): string
    {
        return $this->enderecoColeta;
    }
    public function getECEP(): string
    {
        return $this->CEP;
    }
    public function getTelefoneEquipeResp(): string
    {
        return $this->telefone_equipe_resp;
    }
    public function getNomeEquipeResp(): string
    {
        return $this->nome_equipe_resp;
    }
    public function getCapacidadeMaxima(): float
    {
        return $this->capacidadeMaxima;
    }
    public function getTipoLixo(): string
    {
        return $this->tipoLixo;
    }
    public function getQuantidade(): float
    {
        return $this->quantidade;
    }
    public function getValorTotal(): float
    {
        return $this->valorTotal;
    }
    //Métodos de alteração.
    public function setIdentificacaoColeta(int $identificacao_coleta): void
    {
        $this->identificacao_coleta = $identificacao_coleta;
    }
    public function setDadosRelatorio(string $Dados_relatorio): void
    {
        $this->Dados_relatorio = $Dados_relatorio;
    }
    public function setStatusColeta(string $StatusColeta): void
    {
        $this->status_coleta = $StatusColeta;
    }
    public function setData_coleta(string $data_coleta): void
    {
        $this->data_coleta = $data_coleta;
    }
    public function setHora_coleta(string $hora_coleta): void
    {
        $this->hora_coleta = $hora_coleta;
    }
    public function setEnderecoColeta(string $endereco_coleta): void
    {
        $this->enderecoColeta = $endereco_coleta;
    }
    public function setCEP(string $CEP): void
    {
        $this->CEP = $CEP;
    }
    public function setTelefoneEquipeResp(string $tel_equipe_coleta): void
    {
        $this->telefone_equipe_resp = $tel_equipe_coleta;
    }
    public function setNomeEquipeResp(string $nome_equipe_coleta): void
    {
        $this->nome_equipe_resp = $nome_equipe_coleta;
    }
    public function setCapacidadeMaxima(string $capacidade_max): void
    {
        $this->capacidadeMaxima = $capacidade_max;
    }
    public function setTipoLixo(string $tipo): void
    {
        $this->tipoLixo = $tipo;
    }
    public function setQuantidade(string $quant): void
    {
        $this->quantidade = $quant;
    }
    public function setValorTotal(string $valor_total): void
    {
        $this->valorTotal = $valor_total;
    }

    //Métodos Adicionais da Classe Coleta de Lixo Eletrônico:
    public function verificarDisponibilidade(): void
    {
        if ($this->capacidadeMaxima <= $this->quantidade) {
            echo "A coleta está cheia, por favor, aguarde a próxima coleta";
        } else {
            echo "A coleta está disponível para mais lixo eletrônico.";
        }
    }
    public function calcularValorTotal($valor_por_mao_de_obra_equipe): void
    {
        $this->valorTotal = $this->quantidade * $valor_por_mao_de_obra_equipe;
        echo "O valor total da coleta é R$ " . $this->valorTotal . ".";
    }
    public function registrarDescarte($tipo_lixo, $quantidade, $local_coleta, $data, $hora, $nome_equipe_coleta): void
    {
        echo "O tipo de lixo descartado foi: $tipo_lixo.";
        echo "A quantidade de lixo descartado foi: $quantidade.";
        echo "O local de coleta foi: $local_coleta.";
        echo "A data da coleta foi: $data.";
        echo "A hora da coleta foi: $hora.";
        echo "O nome da equipe de coleta foi: $nome_equipe_coleta.";
        echo "O lixo eletrônico foi descartado com sucesso.";
        //Código em PHP para log de registro de um evento no sistema com data e hora local.
        $data_hora = date(format: "d/m/Y H:i:s");
        $arquivo = fopen(filename: "log_descarte.txt", mode: "a");
        //pasta a ser alocado este documento.
        $caminho = "C:/Users/Usuario/Desktop/Log";
        $nome_arquivo = "log_descarte.txt";
        $caminho_arquivo = $caminho . "/" . $nome_arquivo;
        //Código em PHP para log de registro de um evento no sistema com data e hora local
        $registro = "Data e Hora: $data_hora - Tipo de Lixo:
            $tipo_lixo - Quantidade de Lixo: $quantidade - Local de Coleta
            $local_coleta - Data da Coleta: $data - Hora da Coleta:
            $hora - Nome da Equipe de Coleta: $nome_equipe_coleta.";
        fwrite(stream: $arquivo, data: $registro);
        fclose(stream: $arquivo);
    }
    public function agendarColeta($tipo_lixo, $quantidade, $local_coleta, $data, $hora, $nome_equipe_coleta, $nome_responsavel, $telefone_responsavel, $email_responsavel): void
    {
        //Código para  arquivar um agendamento em uma planilha da Excel e exportar para a pasta download no computador.
        $caminho_arquivo = "C:/Users/Usuario/Desktop/Agendamento.xlsx";
        $nome_arquivo = "Agendamento.xlsx";
        $caminho = "C:/Users/Usuario/Desktop/Agendamento.xlsx";
        $nome_arquivo = "Agendamento.xlsx";
        $caminho_arquivo = $caminho . "/" . $nome_arquivo;
        //Código em PHP para exportar dados para uma planilha da Excel
        $arquivo = fopen(filename: "Agendamento.xlsx", mode: "a");
        $registro = "Tipo de Lixo: $tipo_lixo - Quantidade de Lixo:  $quantidade - Local de Coleta: $local_coleta - Data da Coleta: $data - Hora da Coleta: $hora - Nome da Equipe de Coleta: $nome_equipe_coleta - Nome do responsável : $nome_responsavel - Telefone do responsável: $telefone_responsavel - E-mail do responsável:  $email_responsavel.";
        fwrite(stream: $arquivo, data: $registro);
        echo "A coleta foi agendada com sucesso.";
    }
    public function confirmarColeta(): void
    {
        //Implementar o método para a confirmação da coleta de lixo no local, data e hora que o cliente solicitou.
    }
    public function pesquisarPontosDeColeta($origem, $location): mixed
    {
        //Código para a API de Google Maps em PHP para buscar endereços e rotas próximas via CEP ou endereço.
        require_once("GuzzleHttp\Client");
        function buscarEndereco($location): mixed
        {
            $client = new Client();
            $apiKey = ''; // Substitua pela sua chave de API do Google Map

            try {
                $response = $client->request(method: 'GET', uri: $url);
                $data = json_decode(json: $response->getBody(), associative: true);

                if ($data['status'] === 'OK') {
                    // Retorna o primeiro resultado
                    return $data['results'][0];
                } else {
                    return "Nenhum resultado encontrado para o endereço ou CEP: $location.";
                }
            } catch (Exception $e) {
                return "Erro ao buscar o endereço: " . $e->getMessage();
            }
        }

        function buscarRotas($origem, $destino): mixed
        {
            $client = new Client();
            $apiKey = ''; // Substitua pela sua chave de API do Google Maps
            $url = "";

            try {
                $response = $client->request(method: 'GET', uri: $url);
                $data = json_decode(json: $response->getBody(), associative: true);

                if ($data['status'] === 'OK') {
                    return $data['routes'];
                } else {
                    return "Nenhuma rota encontrada entre $origem e $destino.";
                }
            } catch (Exception $e) {
                return "Erro ao buscar rotas: " . $e->getMessage();
            }
        }
        return buscarEndereco(location: $destino) + " Rotas para o " + $CEP_cliente + ": " + buscarRotas(origem: $origem, destino: $destino);
    }
}
//------------------FIM DA CLASSE ColetaDomiciliar_Amb_Trab----------------//

class Relatorio
{
    private $identificacao_relatorio;
    private $dataGeracao;
    private $nome;
    private $tipoRelatorio; // -tipo: String (impacto ambiental, quantidade coletada, etc.)
    private $conteudo; // -conteudo: data ( dados da API de AI e de outras fontes)
    private $capacidadeBytesArquivo; // -capacidadeBytes: bytes
    private $proprietario;
    private $tipoDoArquivoRelatorio; // Excel.
    private $info_item_donativo;
    private $info_item_venda;
    private $info_coleta_lixo;
    private $time_relatorio;
    //Métodos construtores
    // Método construtor
    public function __construct($identificacao_relatorio, $dataGeracao, $nome, $tipoRelatorio, $conteudo, $capacidadeBytesArquivo, $proprietario, $tipoDoArquivoRelatorio)
    {
        $this->identificacao_relatorio = $identificacao_relatorio;
        $this->dataGeracao = $dataGeracao;
        $this->nome = $nome;
        $this->tipoRelatorio = $tipoRelatorio;
        $this->conteudo = $conteudo;
        $this->capacidadeBytesArquivo = $capacidadeBytesArquivo;
        $this->proprietario = $proprietario;
        $this->tipoDoArquivoRelatorio = $tipoDoArquivoRelatorio;

        // Inicializando as informações de itens e coleta
        $this->info_coleta_lixo = new ColetaDomiciliar_Amb_Trab();
        $time_relatorio = new DateTime();
        //Formatar o tempo em  formato de data e hora
        $this->time_relatorio = $time_relatorio->format(format: 'd/m/Y H:i :s');
    }

    public function getIdentificacao_relatorio(): mixed
    {
        return $this->identificacao_relatorio;
    }
    public function getNome_relatorio(): mixed
    {
        return $this->nome;
    }
    public function getDataGeracao_relatorio(): mixed
    {
        return $this->dataGeracao + " " +  $this->time_relatorio;
    }
    public function getTipoRelatorio(): mixed
    {
        return $this->tipoRelatorio;
    }
    public function getConteudo(): mixed
    {
        return $this->conteudo;
    }
    public function getpProprietario(): mixed
    {
        return $this->proprietario;
    }
    // Métodos adicionais podem ser adicionados aqui
    public function gerarRelatorio(): mixed
    {
        $registro = [];
        // $registro.array_push(array: $this->info_coleta_lixo.agendarColeta());
        // $registro.array_push(array: $this->info_coleta_lixo.registrarDescarte());
        // Código em PHP para gerar os Relatórios mensais de coleta de lixo e descarte.
        $create_relatorio_coleta = new ColetaDomiciliar_Amb_Trab();
        $create_relatorio_descarte = new Descarte();
        $registro . array_push(array: $create_relatorio_coleta);
        $registro . array_push(array: $create_relatorio_descarte);
        return $registro;
    }

    public function imprimirRelatorio(): void
    {
        // Imprimir o Relatório.
        //Código em PHP para imprimir um relatório, pode me ajudar com isso?

        require_once('tcpdf/tcpdf.php');

        // Criar um novo PDF
        $pdf = new TCPDF();
        $pdf->AddPage();

        // Definir fonte
        $pdf->SetFont(family: 'helvetica', style: '', size: 12);

        // Adicionar conteúdo
        $pdf->Cell(w: 0, h: 10, txt: 'Relatório de Usuários', border: 0, ln: 1, align: 'C');
        $pdf->Ln(h: 10);

        // Exemplo de dados
        $usuarios = [
            ['id' => $this->identificacao_relatorio, 'nome' => $this->nome, 'data e hora' => $this->dataGeracao, 'proprietário' => $this->proprietario],
            ['id' => $this->identificacao_relatorio, 'nome' => 'Maria', 'data' => $this->dataGeracao, 'proprietário' => $this->proprietario],
            ['id' => $this->identificacao_relatorio, 'nome' => 'Pedro', 'data' => $this->dataGeracao, 'proprietário' => $this->proprietario],
        ];

        // Criar tabela
        $html = '<table border="1" cellpadding="4">';
        $html .= '<tr><th>ID</th><th>Nome</th><th>Email</th></tr>';
        foreach ($usuarios as $usuario) {
            $html .= '<tr>';
            $html .= '<td>' . $usuario['id'] . '</td>';
            $html .= '<td>' . $usuario['nome'] . '</td>';
            $html .= '<td>' . $usuario['data'] . '</td>';
            $html .= '<td>' . $usuario['proprietário'] . '</td>';
            $html .= '</tr>';
        }
        $html .= '</table>';

        // Adicionar tabela ao PDF
        $pdf->writeHTML(html: $html, ln: true, fill: false, reseth: true, cell: false, align: '');

        // Fechar e gerar o PDF
        $pdf->Output(name: 'relatorio_usuarios.pdf', dest: 'D');

        // Criar nova planilha
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Definir cabeçalhos
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Nome');
        $sheet->setCellValue('C1', 'Email');

        // Exemplo de dados
        $usuarios = [
            ['id' => $this->identificacao_relatorio, 'nome' => $this->nome, 'data e hora' => $this->dataGeracao, 'proprietário' => $this->proprietario],
            ['id' => $this->identificacao_relatorio, 'nome' => $this->nome, 'data' => $this->dataGeracao, 'proprietário' => $this->proprietario],
            ['id' => $this->identificacao_relatorio, 'nome' => $this->nome, 'data' => $this->dataGeracao, 'proprietário' => $this->proprietario],
        ];

        // Adicionar dados à planilha
        $row = 2; // Começar na segunda linha
        foreach ($usuarios as $usuario) {
            $sheet->setCellValue('A' . $row, $usuario['id']);
            $sheet->setCellValue('B' . $row, $usuario['nome']);
            $sheet->setCellValue('C' . $row, $usuario['data']);
            $sheet->setCellValue('C' . $row, $usuario['proprietário']);
            $row++;
        }

        // Criar o arquivo Excel
        $writer = new Xlsx($spreadsheet);
        $writer->save('relatorio_usuarios.xlsx');
    }

    public function salvarRelatorio($identificacao_relatorio, $dataGeracao, $nome, $tipo, $conteudo, $capacidadeBytes, $proprietario, $tipoArquivo, $idUsuario_cliente, $idAdministrador): void
    {
        //Método para salvar o objeto relatório no sistema de banco de dados MySQL.
        //Método para salvar o objeto Relatorio no sistema de banco de dados MySQL.

        $db = new Relatorio_DAO(host: 'localhost', username: 'root', password: '', dbname: '');
        $db->connect();
        $db->executeQuery(sql: "INSERT INTO relatorios (identificacao, dataGeracao, nome, tipo, conteudo, capacidadeBytes, proprietario, tipoArquivo, idUsuario_cliente, idAdministrador) VALUES ('$identificacao_relatorio', '$dataGeracao', '$nome', '$tipo', '$conteudo', '$capacidadeBytes', '$proprietario', '$tipoArquivo', '$idUsuario_cliente, $idAdministrador')");
        $db->disconnect();
        echo "Relatório criado/salvo com sucesso.";
    }

    public function visualizarRelatorio($identificacao_relatorio, $dataGeracao, $nome, $tipo, $conteudo, $capacidadeBytes, $proprietario, $tipoArquivo, $idUsuario_cliente, $idAdministrador): mixed
    {
        //Método para abrir o arquivo em que está localizado o relatório salvo no método 'Imprimir'.

        $db = new Relatorio_DAO(host: 'localhost', username: 'root', password: '', dbname: '');
        $db->connect();
        $db->fetchAll(sql: "SELECT * FROM relatorios (identificacao, dataGeracao, nome, tipo, conteudo, capacidadeBytes, proprietario, tipoArquivo, idUsuario_cliente, idAdministrador) VALUES ('$identificacao_relatorio', '$dataGeracao', '$nome', '$tipo', '$conteudo', '$capacidadeBytes', '$proprietario', '$tipoArquivo', '$idUsuario_cliente, $idAdministrador')");
        $db->disconnect();
        echo "Agendamentos Exibido com sucesso.";

        // Exemplo de dados de usuários
        $usuarios = [
            ['id' => $this->identificacao_relatorio, 'nome' => $this->nome, 'data e hora' => $this->dataGeracao, 'proprietário' => $this->proprietario],
            ['id' => $this->identificacao_relatorio, 'nome' => $this->nome, 'data' => $this->dataGeracao, 'proprietário' => $this->proprietario],
            ['id' => $this->identificacao_relatorio, 'nome' => $this->nome, 'data' => $this->dataGeracao, 'proprietário' => $this->proprietario],
        ];

        // Função para gerar o relatório
        function gerarRelatorio($usuarios): void
        {
            // Começa a saída do HTML
            echo "<html>";
            echo "<head>";
            echo "<title>Relatório de Coleta de Lixo Eletrônico</title>";
            echo "<style>";
            echo "table { width: 100%; border-collapse: collapse; }";
            echo "th, td { border: 1px solid black; padding: 8px; text-align: left; }";
            echo "th { background-color: #f2f2f2; }";
            echo "</style>";
            echo "</head>";
            echo "<body>";
            echo "<h1>Relatório de Coleta de Lixo Eletrônico</h1>";
            echo "<table>";
            echo "<tr><th>ID</th><th>Nome</th><th>Data</th><th>Proprietário</th></tr>";

            // Loop pelos usuários e cria uma linha na tabela para cada um
            foreach ($usuarios as $usuario) {
                echo "<tr>";
                echo "<td>" . $usuario['id'] . "</td>";
                echo "<td>" . $usuario['nome'] . "</td>";
                echo "<td>" . $usuario['data'] . "</td>";
                echo "<td>" . $usuario['proprietário'] . "</td>";
                echo "</tr>";
            }

            echo "</table>";
            echo "</body>";
            echo "</html>";
        }

        // Chama a função para gerar o relatório
        gerarRelatorio(usuarios: $usuarios);

        return $db;
    }
}

//------------------FIM DA CLASSE Relatório----------------//

class Agendamento_coleta extends ColetaDomiciliar_Amb_Trab
{
    private $identificacao;
    private $data;
    private $hora;
    private $endereco;
    private $CEP;
    private $telefone;
    private $nomeIntegrantes_equipe;
    private $info_usuario; // Um objeto da classe Usuário_cliente
    private $info_coleta; // Um objeto da classe de ColetaDomiciliar_Amb_Trab
    private $status_coleta; // String (Solicitada, Aprovada, Cancelada)

    //Método construtor 
    public function __construct($identificacao, $data, $hora, $endereco, $CEP, $telefone, $nomeIntegrantes_equipe, $info_usuario, $info_coleta, $status_coleta)
    {
        parent::__construct(identificacao_coleta: $identificacao, Dados_relatorio: $info_coleta->getDadosRelatorio(), status_coleta: $status_coleta, data_coleta: $data, hora_coleta: $hora, enderecoColeta: $endereco, CEP: $CEP, telefone_equipe_resp: '', nome_equipe_resp: $nomeIntegrantes_equipe, capacidadeMaxima: 0, tipoLixo: '', quantidade: $info_coleta->getQuantidade(), valorTotal: $info_coleta->getValorTotal());
        $this->identificacao = $identificacao;
        $this->data = $data;
        $this->hora = $hora;
        $this->endereco = $endereco;
        $this->CEP = $CEP;
        $this->telefone = $telefone;
        $this->nomeIntegrantes_equipe = $nomeIntegrantes_equipe;
        $this->info_usuario = $info_usuario; // Um objeto da classe Usuário_cliente
        $this->info_coleta = $info_coleta; // Um objeto da classe de ColetaDomiciliar_Amb_Trab
        $this->status_coleta = $status_coleta;
    }

    //Métodos de Acesso e Retorno

    public function getIdentificacao(): mixed
    {
        return $this->identificacao;
    }
    public function getdata(): mixed
    {
        return $this->data;
    }
    public function gethora(): mixed
    {
        return $this->hora;
    }
    public function getendereco(): mixed
    {
        return $this->endereco;
    }
    public function getCEP(): mixed
    {
        return $this->CEP;
    }
    public function gettelefone(): mixed
    {
        return $this->telefone;
    }
    public function getnomeIntegrantes_equipe(): mixed
    {
        return $this->nomeIntegrantes_equipe;
    }
    public function getinfo_usuario(): mixed
    {
        return $this->info_usuario;
    }
    public function getinfo_coleta(): mixed
    {
        return $this->info_coleta;
    }
    public function getstatus_coleta(): mixed
    {
        return $this->status_coleta;
    }

    //Métodos Adicionais à classe Agendamento
    public function salvarAgendamento($identificacao_coleta, $data, $time, $reserva, $nomeIntegrantes_equipe, $status_coleta, $idUsuario, $idEquipe, $idRelatorio): void
    {
        //Método para salvar o objeto Agendamento no sistema de banco de dados MySQL.
        $db = new Agendamento_DAO(host: 'localhost', username: 'root', password: '', dbname: '');
        $db->connect();
        $db->executeQuery(sql: "INSERT INTO agendamento_coleta (identificacao, data, hora, reservar, NomeIntegrantes_equipe, status_coleta, idUsuario_cliente, idMotorista_Equipe, idRelatorio) VALUES ('$identificacao_coleta', '$data', '$time', '$reserva', '$nomeIntegrantes_equipe', '$status_coleta', '$idUsuario', '$idEquipe', '$idRelatorio')");
        $db->disconnect();
        echo "Agendamento criado com sucesso.";
    }
}

//------------------FIM DA CLASSE Relatório----------------//

class Descarte extends ColetaDomiciliar_Amb_Trab
{
    private $tipoLixo_reciclavel;  // Tipo de lixo reciclável
    private $quantidadeLixo_reciclavel;
    private $tipoLixo_nao_reciclavel;
    private $quantidadeLixo_nao_reciclavel;
    private $info_coleta; // Objeto da classe mãe ColetaDomiciliar_Amb_Trab
    private $info_ponto_coleta;  // Objeto da classe PontoColeta

    //Método construtor 
    public function __construct($tipoLixo_reciclavel, $quantidadeLixo_reciclavel, $tipoLixo_nao_reciclavel, $quantidadeLixo_nao_reciclavel, $info_coleta)
    {

        $this->tipoLixo_reciclavel = $tipoLixo_reciclavel;
        $this->quantidadeLixo_reciclavel = $quantidadeLixo_reciclavel;
        $this->quantidadeLixo_nao_reciclavel = $quantidadeLixo_nao_reciclavel;
        $this->tipoLixo_nao_reciclavel = $tipoLixo_nao_reciclavel;
        $this->info_coleta = $info_coleta;
    }

    //Métodos de Acesso e Retorno
    public function gettipoLixoReciclavel(): mixed
    {
        return $this->tipoLixo_reciclavel;
    }
    public function settipoLixoReciclavel($tipoLixo_reciclavel): void
    {
        $this->tipoLixo_reciclavel = $tipoLixo_reciclavel;
    }

    public function getquantidadeLixo_reciclavel(): mixed
    {
        return $this->tipoLixo_reciclavel;
    }
    public function setquantidadeLixo_reciclavel($quantidadeLixo_reciclavel): void
    {
        $this->quantidadeLixo_reciclavel = $quantidadeLixo_reciclavel;
    }

    public function getquantidade_lixo_nao_reciclavel(): mixed
    {
        return $this->quantidadeLixo_nao_reciclavel;
    }
    public function setquantidade_lixo_nao_reciclavel($quantidadeLixo_nao_reciclavel): void
    {
        $this->quantidadeLixo_nao_reciclavel = $quantidadeLixo_nao_reciclavel;
    }

    public function gettipoLixo_nao_reciclavel(): mixed
    {
        return $this->tipoLixo_nao_reciclavel;
    }
    public function settipoLixo_nao_reciclavel($tipoLixo_nao_reciclavel): void
    {
        $this->tipoLixo_nao_reciclavel = $tipoLixo_nao_reciclavel;
    }

    public function getinfo_coleta(): mixed
    {
        return $this->info_coleta;
    }
    public function setinfo_coleta($info_coleta): void
    {
        $this->info_coleta = $info_coleta;
    }

    //Métodos Adicionais à classe Descarte
    public function registrarProcessos(): void
    {
        // Implementar o método de transparência sobre a vida útil do tipo de resíduo e seu ciclo de descarte.
        print_r(value: $this->info_coleta);
        print($this->tipoLixo_reciclavel);
        print($this->tipoLixo_nao_reciclavel);
        print($this->quantidadeLixo_reciclavel);
        print($this->quantidadeLixo_nao_reciclavel);
        // gere um código para gerar um relátorio de descarte em planilha da excel e exporte para a pasta downloads no meu computador.  
        // Função para gerar relatório de descarte
        function gerarRelatorioDescarte($dados): void
        {
            // Cria uma nova planilha
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            // Define o cabeçalho da planilha
            $sheet->setCellValue('A1', 'Identificação');
            $sheet->setCellValue('B1', 'Localização');
            $sheet->setCellValue('C1', 'Nome');
            $sheet->setCellValue('D1', 'Endereço');
            $sheet->setCellValue('E1', 'Telefone');
            $sheet->setCellValue('F1', 'Capacidade Máxima');
            $sheet->setCellValue('G1', 'Quantidade de Lixo Reciclável');
            $sheet->setCellValue('H1', 'Quantidade de Lixo NÃO Reciclável');

            // Preenche os dados na planilha
            $linha = 2; // Começa na segunda linha
            foreach ($dados as $pontoColeta) {
                $sheet->setCellValue('A' . $linha, $pontoColeta['identificacao']);
                $sheet->setCellValue('B' . $linha, $pontoColeta['localizacao']);
                $sheet->setCellValue('C' . $linha, $pontoColeta['nome']);
                $sheet->setCellValue('D' . $linha, $pontoColeta['endereco']);
                $sheet->setCellValue('E' . $linha, $pontoColeta['telefone']);
                $sheet->setCellValue('F' . $linha, $pontoColeta['capacidade_Max']);
                $sheet->setCellValue('G' . $linha, $pontoColeta['quant_lixo_reciclavel']);
                $sheet->setCellValue('H' . $linha, $pontoColeta['quant_lixo_NAO_reciclavel']);
                $linha++;
            }

            // Define o caminho para salvar o arquivo
            $pastaDownloads = getenv(name: 'USERPROFILE') . '/Downloads/'; // Para Windows
            // $pastaDownloads = getenv('HOME') . '/Downloads/'; // Para Linux/Mac
            $nomeArquivo = 'relatorio_descarte.xlsx';
            $caminhoArquivo = $pastaDownloads . $nomeArquivo;

            // Salva o arquivo
            $writer = new Xlsx($spreadsheet);
            $writer->save($caminhoArquivo);

            echo "Relatório de descarte gerado com sucesso em: " . $caminhoArquivo;
        }

        // Exemplo de dados para o relatório
        $dadosPontoColeta = [
            [
                'identificacao' => $this->info_coleta->getIdentificacaoColeta(),
                'localizacao' =>  $this->info_ponto_coleta->getLocalizacao(),
                'nome' => $this->info_ponto_coleta->getnome(),
                'endereco' => $this->info_ponto_coleta->getendereco(),
                'telefone' => $this->info_ponto_coleta->gettelefone(),
                'capacidade_Max' => $this->info_ponto_coleta->getcapacidade_max(),
                'quant_lixo_reciclavel' => $this->getquantidadeLixo_reciclavel(),
                'quant_lixo_NAO_reciclavel' => $this->getquantidade_lixo_nao_reciclavel(),
            ],
        ];

        // Chama a função para gerar o relatório
        gerarRelatorioDescarte(dados: $dadosPontoColeta);
    }
}

//------------------FIM DA CLASSE Descarte----------------//

class PontoColeta extends ColetaDomiciliar_Amb_Trab
{
    private $identificacao;
    private $localizacao;
    private $nome;
    private $endereco;
    private $telefone;
    private $capacidade_Max;
    private $info_descarte;
    private $info_coleta;

    //Método construtor
    public function __construct($identificacao, $localizacao, $nome, $endereco, $telefone, $capacidade_max, $info_descarte, $info_coleta)
    {
        $this->identificacao = $identificacao;
        $this->localizacao = $localizacao;
        $this->nome = $nome;
        $this->endereco = $endereco;
        $this->telefone = $telefone;
        $this->capacidade_Max = $capacidade_max;
        $this->info_descarte = $info_descarte;
        $this->info_coleta = $info_coleta;
    }

    //Métodos de Acesso e de Recuperação de dados
    public function getIdentificacao(): mixed
    {
        return $this->identificacao;
    }
    public function setIdentificacao($tipoLixo_reciclavel): void
    {
        $this->identificacao = $tipoLixo_reciclavel;
    }
    public function getLocalizacao(): mixed
    {
        return $this->localizacao;
    }
    public function setLocalizacao($localizacao): void
    {
        $this->localizacao = $localizacao;
    }
    public function getnome(): mixed
    {
        return $this->nome;
    }
    public function setnome($nome): void
    {
        $this->nome = $nome;
    }
    public function getendereco(): mixed
    {
        return $this->endereco;
    }
    public function setendereco($endereco): void
    {
        $this->endereco = $endereco;
    }
    public function gettelefone(): mixed
    {
        return $this->telefone;
    }
    public function settelefone($telefone): void
    {
        $this->telefone = $telefone;
    }
    public function getcapacidade_max(): mixed
    {
        return $this->capacidade_Max;
    }
    public function setcapacidade_max($capacidade_Max): void
    {
        $this->capacidade_Max = $capacidade_Max;
    }
    public function getinfo_descarte(): mixed
    {
        return $this->info_descarte;
    }
    public function setinfo_descarte($info_descarte): void
    {
        $this->info_descarte = $info_descarte;
    }
    public function getinfo_coleta(): mixed
    {
        return  $this->info_coleta;
    }
    public function setinfo_coleta($info_coleta): void
    {
        $this->info_coleta = $info_coleta;
    }

    //Métodos Adicionais à classe Descarte
    public  function getTipoLixoReciclavel(): void
    {
        print_r(value: $this->info_descarte->gettipoLixoReciclavel());
        print($this->info_descarte->getquantidadeLixo_reciclavel());
        print($this->info_descarte->gettipoLixo_nao_reciclavel());
        print($this->info_descarte->getquantidade_lixo_nao_reciclavel());
        print($this->info_coleta);
        print($this->info_descarte);
    }
    public function gestaoColeta($Lista_coleta, $info_coleta, $opcoes, $id_coleta, $new_info_coleta): mixed
    {
        $Lista_coleta = [];

        switch ($opcoes) {
            case "LISTAR":
                return print_r(value: $Lista_coleta);
            case "ADICIONAR":
                $Lista_coleta . array_push(array: $info_coleta);
                return print_r(value: $Lista_coleta);
            case "REMOVER":
                $Lista_coleta . array_pop(array: $info_coleta);
                return print_r(value: $Lista_coleta);
            case "ALTERAR":
                $Lista_coleta . array_splice(array: $info_coleta, offset: $id_coleta, length: $new_info_coleta);
                return print_r(value: $Lista_coleta);
        }
    }
    public function gestaoDescarte($Lista_descarte, $opcoes, $info_descarte, $id_descarte, $new_info_descarte): mixed
    {
        switch ($opcoes) {
            case "LISTAR":
                return print_r(value: $Lista_descarte);
            case "ADICIONAR":
                $Lista_descarte . array_push(array: $info_descarte);
                return print_r(value: $Lista_descarte);
            case "REMOVER":
                $Lista_descarte . array_pop(array: $info_descarte);
                return print_r(value: $Lista_descarte);
            case "ALTERAR":
                $Lista_descarte . array_splice(array: $info_descarte, offset: $id_descarte, length: $new_info_descarte);
                return print_r(value: $Lista_descarte);
        }
    }
}

//------------------FIM DA CLASSE PontoColeta----------------//

class Equipe_coleta extends Pessoa
{
    private $identificacao_equip;
    private $nome_equip;
    private $email_equip;
    private $endereco_trab_equip;
    private $telefone_trab_equip;
    private $senha;

    private $coleta;

    private $data_nascimento;
    public function __construct($identificacao_equip, $nome_equip, $email_equip, $endereco_trab_equip, $telefone_trab_equip, $data_nascimento, $senha)
    {
        parent::__construct(identificacao: $identificacao_equip, nome: $nome_equip, email: $email_equip, endereco: $endereco_trab_equip, telefone: $telefone_trab_equip, data_nascimento: $data_nascimento,  senha: $senha);

        $this->identificacao_equip = $identificacao_equip;
        $this->nome_equip = $nome_equip;
        $this->email_equip = $email_equip;
        $this->endereco_trab_equip = $endereco_trab_equip;
        $this->telefone_trab_equip = $telefone_trab_equip;
        $this->senha = $senha;
        $this->coleta;
    }

    public function getIdentificacaoEquip(): mixed
    {
        return $this->identificacao_equip;
    }
    public function getNomeEquipe(): mixed
    {
        return $this->nome_equip;
    }
    public function getEmailEquip(): mixed
    {
        return $this->email_equip;
    }
    public function getEnderecoEquip(): mixed
    {
        return $this->endereco_trab_equip;
    }
    public function getTelefoneEquip(): mixed
    {
        return $this->telefone_trab_equip;
    }
    public function getSenhaEquip(): mixed
    {
        return $this->senha;
    }
    public function getColeta(): mixed
    {
        return $this->coleta;
    }

    public function setIdentificacaoEquip($identificacao_equip): void
    {
        $this->identificacao_equip = $identificacao_equip;
    }
    public function setNomeEquip($nome_equip): void
    {
        $this->nome_equip = $nome_equip;
    }
    public function setEmailEquip($email_equip): void
    {
        $this->email_equip = $email_equip;
    }
    public function setIEnderecoEquip($endereco_equip): void
    {
        $this->endereco_trab_equip = $endereco_equip;
    }
    public function setITelefoneEquip($telefone_equip): void
    {
        $this->telefone_trab_equip = $telefone_equip;
    }
    public function setSenhaEquip($senha_equip): void
    {
        $this->senha = $senha_equip;
    }
    public function setColeta($coleta): void
    { // Coleta é do tipo Objeto Coleta
        $this->coleta = $coleta;
    }

    //Métodos Adicionais 
    public function recolherLixo($coleta): mixed
    { // coleta é um objeto
        //Implementar o método aqui
        $this->setColeta(coleta: $coleta);
        return print("O status da coleta é: " + $coleta->getStatusColeta());
    }
    public function confirmarColeta($coleta): mixed
    {
        //Implementar o método aqui
        if ($coleta == null) {
            return print("A coleta precisa ser efetuada.");
        } else {
            return print("A coleta já foi efetuada.");
        }
    }
    public function gerenciarColetas($coleta): mixed
    {
        //Implementar o método aqui
        return print("Localização da coleta: " + $coleta->getEnderecoColeta() + ", preço total: R$" + $coleta->getValorTotal());
    }
    public function registrar($identificacao, $nome, $endereco, $telefone, $data_nascimento, $senha, $email): void
    {
        $identificacao_equip = random_int(min: 1000, max: 9999);
        //Implementação do método de registro de um usuário.
        //Verificar se o usuário já existe.
        $db = new Pessoa_DAO(host: 'localhost', username: 'root', password: '', dbname: '');
        $db->connect();
        $results = $db->fetchAll(sql: "SELECT * FROM pessoa WHERE email = '$email' AND  senha = '$senha'");
        $db->disconnect();
        if ($results !== null) {
            echo "\nJá existe um usuário com esse e-mail.";
        } else {
            $db = new Equipe_coleta_DAO(host: 'localhost', username: 'root', password: '', dbname: '');
            $db->connect();
            $db->executeQuery(sql: "INSERT INTO pessoa (identificacao, nome, email, endereco, telefone, data_nascimento, senha) VALUES ('$identificacao', '$nome', '$email', '$endereco', '$telefone', '$data_nascimento', $senha')");
            $db->executeQuery(sql: "INSERT INTO equipe_coleta (identificacao_equip, idPessoa) VALUES ('$identificacao_equip', '$identificacao')");
            $db->disconnect();
            echo "Usuário criado com sucesso.";
            header(header: "/WebPages_eLixo_frontend/Tela_login_e-LIXO_BlackBoxAi.html");
        }
    }
}

//------------------FIM DA CLASSE  Equipe de Coleta de Lixo----------------//

class Administrador extends Pessoa
{
    private $identificador;
    private $nome_admin;
    private $email_admin;
    private $endereco_admin;
    private $tel_admin;
    private $data_nascimento;
    private $senha;
    protected $List_pontoColeta = [];
    protected $List_relatorios = [];
    protected $List_coletas = [];

    public function __construct($identificador, $nome_admin, $email_admin, $endereco_admin, $tel_admin, $data_nascimento, $senha)
    {
        parent::__construct(identificacao: $identificador, nome: $nome_admin, email: $email_admin, endereco: $endereco_admin, telefone: $tel_admin, data_nascimento: $data_nascimento, senha: $senha);

        $this->identificador = $identificador;
        $this->nome_admin = $nome_admin;
        $this->email_admin = $email_admin;
        $this->endereco_admin = $endereco_admin;
        $this->tel_admin = $tel_admin;
        $this->data_nascimento = $data_nascimento;
        $this->senha = $senha;
    }

    // Métodos de Acesso e de Recuperação de dados
    public function getIdentificador_admin(): mixed
    {
        return $this->identificador;
    }
    public function getNome_admin(): mixed
    {
        return $this->nome_admin;
    }
    public function getEmail_admin(): mixed
    {
        return $this->email_admin;
    }
    public function getEndereco(): mixed
    {
        return $this->endereco_admin;
    }
    public function getTelefone_admin(): mixed
    {
        return $this->tel_admin;
    }
    public function getData_nascimento(): mixed
    {
        return $this->data_nascimento;
    }
    public function getSenha_admin(): mixed
    {
        return $this->senha;
    }

    public function setIdentificador_admin($identificador): void
    {
        $this->identificador = $identificador;
    }
    public function setNome_admin($nome_admin): void
    {
        $this->nome_admin = $nome_admin;
    }
    public function setEmail_admin($email_admin): void
    {
        $this->email_admin = $email_admin;
    }
    public function setEndereco($endereco_admin): void
    {
        $this->endereco_admin = $endereco_admin;
    }
    public function setTelefone_admin($tel_admin): void
    {
        $this->tel_admin = $tel_admin;
    }
    public function setData_nascimento($data_nascimento): void
    {
        $this->data_nascimento = $data_nascimento;
    }
    public function setSenha($senha): void
    {
        $this->senha = $senha;
    }

    //Métodos Adicionanais à classe Admin
    public function adicionarPontoColeta($List_pontoColeta, $ponto_coleta): void
    {
        $pt = new PontoColeta(identificacao: $ponto_coleta);
        $List_pontoColeta . array_push(array: $pt);
    }
    public function removerPontoColeta($List_pontoColeta, $ponto_coleta): void
    {
        $List_pontoColeta . array_pop(array: $ponto_coleta);
    }
    public function gerarRelatorios($List_relatorios, $relatorio): void
    {
        $relatorio = new Relatorio(identificacao_relatorio: $relatorio);
        $List_relatorios . array_push(array: $relatorio);
    }
    public function gerenciarRelatorios($List_relatorios, $relatorio, $opcoes, $id_relatorio, $new_relatorio): mixed
    {
        switch ($opcoes) {
            case "EDITAR":
                $List_relatorios . array_push(array: $relatorio);
                print_r(value: $List_relatorios);
                break;
            case "ADICIONAR":
                $List_relatorios . array_slice(array: $relatorio, offset: $id_relatorio, length: $new_relatorio);
                print_r(value: $List_relatorios);
                break;
            case "REMOVER":
                $List_relatorios . array_pop(array: $relatorio);
                print_r(value: $List_relatorios);
                break;
            case "LISTAR":
                print_r(value: $List_relatorios);
                break;
            default:
                return print("Opção inválida!");
        }
    }
    public function gerenciarColeta($List_coletas, $coleta, $opcoes, $id_coleta, $new_coleta): mixed
    {
        $dados_coleta = new ColetaDomiciliar_Amb_Trab(identificacao_coleta: $coleta);

        switch ($opcoes) {
            case "EDITAR":
                $List_coletas . array_push(array: $dados_coleta);
                print_r(value: $List_coletas);
                break;
            case "ADICIONAR":
                $List_coletas . array_slice(array: $dados_coleta, offset: $id_coleta, length: $new_coleta);
                print_r(value: $List_coletas);
                break;
            case "REMOVER":
                $List_coletas . array_pop(array: $dados_coleta);
                print_r(value: $List_coletas);
                break;
            case "LISTAR":
                print_r(value: $List_coletas);
                break;
            default:
                return print("Opção inválida!");
        }
    }

    public function registrar($identificacao, $nome, $endereco, $telefone, $data_nascimento, $senha, $email): void
    {
        $identificacao_admin = random_int(min: 1000, max: 9999);
        //Implementação do método de registro de um usuário.
        //Verificar se o usuário já existe.
        $db = new Pessoa_DAO(host: 'localhost', username: 'root', password: '', dbname: '');
        $db->connect();
        $results = $db->fetchAll(sql: "SELECT * FROM pessoa WHERE email = '$email' AND  senha = '$senha'");
        $db->disconnect();
        if ($results !== null) {
            echo "\nJá existe um usuário com esse e-mail.";
        } else {
            $db = new Administrador_DAO(host: 'localhost', username: 'root', password: '', dbname: '');
            $db->connect();
            $db->executeQuery(sql: "INSERT INTO pessoa (identificacao, nome, email, endereco, telefone, data_nascimento, senha) VALUES ('$identificacao', '$nome', '$email', '$endereco', '$telefone', '$data_nascimento', $senha')");
            $db->executeQuery(sql: "INSERT INTO administrador (identificacao_admin, idPessoa) VALUES ('$identificacao_admin', '$identificacao')");
            $db->disconnect();
            echo "Usuário criado com sucesso.";
            header(header: "/WebPages_eLixo_frontend/Tela_login_e-LIXO_BlackBoxAi.html");
        }
    }
}

//------------------FIM DA CLASSE  Administrador do S.I----------------//

class Fiscal extends Pessoa
{
    private $identificador;
    private $nome_fiscal;
    private $email_fiscal;
    private $endereco_fiscal;
    private $tel_fiscal;
    private $data_nascimento;
    private $senha;
    private $aval;
    protected $List_pontoColeta = [];
    protected $List_relatorios = [];
    protected $List_coletas = [];

    public function __construct($identificador, $nome_fiscal, $email_fiscal, $endereco_fiscal, $tel_fiscal, $data_nascimento, $senha, $aval)
    {
        parent::__construct(identificacao: $identificador, nome: $nome_fiscal, email: $email_fiscal, endereco: $endereco_fiscal, telefone: $tel_fiscal, data_nascimento: $data_nascimento, senha: $senha);

        $this->identificador = $identificador;
        $this->nome_fiscal = $nome_fiscal;
        $this->email_fiscal = $email_fiscal;
        $this->endereco_fiscal = $endereco_fiscal;
        $this->tel_fiscal = $tel_fiscal;
        $this->data_nascimento = $data_nascimento;
        $this->senha = $senha;
        $this->aval = $aval;
    }

    // Métodos de Acesso e de Recuperação de dados
    public function getIdentificador_fiscal(): mixed
    {
        return $this->identificador;
    }
    public function getNome_fiscal(): mixed
    {
        return $this->nome_fiscal;
    }
    public function getEmail_fiscal(): mixed
    {
        return $this->email_fiscal;
    }
    public function getEndereco(): mixed
    {
        return $this->endereco_fiscal;
    }
    public function getTelefone_fiscal(): mixed
    {
        return $this->tel_fiscal;
    }
    public function getData_nascimento(): mixed
    {
        return $this->data_nascimento;
    }
    public function getSenha_fiscal(): mixed
    {
        return $this->senha;
    }
    public function getAval(): mixed
    {
        return $this->aval;
    }
    public function setAval($aval): void
    {
        $this->aval = $aval;
    }


    public function setIdentificador_fiscal($identificador): void
    {
        $this->identificador = $identificador;
    }
    public function setNome_fiscal($nome_fiscal): void
    {
        $this->nome_fiscal = $nome_fiscal;
    }
    public function setEmail_fiscal($email_fiscal): void
    {
        $this->email_fiscal = $email_fiscal;
    }
    public function setEndereco($endereco_fiscal): void
    {
        $this->endereco_fiscal = $endereco_fiscal;
    }
    public function setTelefone_fiscal($tel_fiscal): void
    {
        $this->tel_fiscal = $tel_fiscal;
    }
    public function setData_nascimento($data_nascimento): void
    {
        $this->data_nascimento = $data_nascimento;
    }
    public function setSenha($senha): void
    {
        $this->senha = $senha;
    }

    //Métodos Adicionanais à classe Fiscal
    public function FiscalizarLixo(): void
    {
        //Implementar o método.
    }
    public function FiscalizarRelatorio(): void
    {
        //Implementar o método.
    }
    public function gerarRelatorioFiscal($relatorio, $List_relatorios): void
    {
        // Método Construtor de classe Relatorio: 
        // $identificacao_relatorio, $dataGeracao, $nome, 
        // $tipoRelatorio, $conteudo, $capacidadeBytesArquivo, $proprietario, $tipoDoArquivoRelatorio

        $relatorio = new Relatorio(identificacao_relatorio: 1204, dataGeracao: "2023/09/13", nome: "Impacto Ambiental no Corrego Ribeirinha", tipoRelatorio: "Analítico/Pericial", conteudo: "conteudo_relatorio_aqui", capacidadeBytesArquivo: 23, proprietario: "Mendonça Silva", tipoDoArquivoRelatorio: ".word"); //relatorio é um objeto da classe Relatorio!
        $array_objet = [];
        $array_objet = $relatorio;
        print_r(value: $List_relatorios);
        print_r(value: $array_objet);
        function gerarRelatorioFiscal($dados): void
        {
            // Cria uma nova planilha
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            // Define o cabeçalho da planilha
            $sheet->setCellValue('A1', 'Identificação');
            $sheet->setCellValue('B1', 'Lixo Reciclável');
            $sheet->setCellValue('C1', 'Lixo NÃO Reciclável');
            $sheet->setCellValue('D1', 'Quantidade de Lixo Reciclável');
            $sheet->setCellValue('E1', 'Quantidade de Lixo NÃO Reciclável');
            $sheet->setCellValue('F1', 'Nome do Fiscal');
            $sheet->setCellValue('G1', 'Informações da Coleta de Lixo');
            $sheet->setCellValue('H1', 'Aval Fiscal');

            // Preenche os dados na planilha
            $linha = 2; // Começa na segunda linha
            foreach ($dados as $pontoColeta) {
                $sheet->setCellValue('A' . $linha, $pontoColeta['identificacao']);
                $sheet->setCellValue('B' . $linha, $pontoColeta['Lixo Reciclável']);
                $sheet->setCellValue('C' . $linha, $pontoColeta['Lixo NÃO Reciclável']);
                $sheet->setCellValue('D' . $linha, $pontoColeta['Quantidade de Lixo Reciclável']);
                $sheet->setCellValue('E' . $linha, $pontoColeta['Quantidade de Lixo NÃO Reciclável']);
                $sheet->setCellValue('F' . $linha, $pontoColeta['Nome do Fiscal']);
                $sheet->setCellValue('G' . $linha, $pontoColeta['Informações da Coleta de Lixo']);
                $sheet->setCellValue('H' . $linha, $pontoColeta['Aval Fiscal']);
                $linha++;
            }

            // Define o caminho para salvar o arquivo
            $pastaDownloads = getenv(name: 'USERPROFILE') . '/Downloads/'; // Para Windows
            // $pastaDownloads = getenv('HOME') . '/Downloads/'; // Para Linux/Mac
            $nomeArquivo = 'relatorio_descarte.xlsx';
            $caminhoArquivo = $pastaDownloads . $nomeArquivo;

            // Salva o arquivo
            $writer = new Xlsx($spreadsheet);
            $writer->save($caminhoArquivo);

            echo "Relatório de descarte gerado com sucesso em: " . $caminhoArquivo;
        }

        // Exemplo de dados para o relatório
        $dadosPontoColeta = [
            [
                'identificacao' => $this->getIdentificador_fiscal(),
                'Lixo Reciclável' =>  $relatorio->gettipoLixoReciclavel(),
                'Lixo NÃO Reciclável' => $relatorio->getquantidade_lixo_nao_reciclavel(),
                'Quantidade de Lixo Reciclável' => $relatorio->getquantidadeLixo_reciclavel(),
                'Quantidade de Lixo NÃO Reciclável' => $relatorio->getquantidade_lixo_nao_reciclavel(),
                'Nome do Fiscal' => $this->getNome_fiscal(),
                'Informações da Coleta de Lixo' => $relatorio->getinfo_coleta(),
                'Aval Fiscal' => $this->getAval(),
            ],
        ];

        // Chama a função para gerar o relatório
        gerarRelatorioFiscal(dados: $dadosPontoColeta);
    }
    public function FiscalizarPontoColeta(): void
    {
        //Implementar o método.
    }
    public function EmitirNotasFiscais(): void
    {
        //Implementar o método.
    }

    public function registrar($identificacao, $nome, $endereco, $telefone, $data_nascimento, $senha, $email): void
    {
        $identificacao_fiscal = random_int(min: 1000, max: 9999);
        //Implementação do método de registro de um usuário.
        //Verificar se o usuário já existe.
        $db = new Pessoa_DAO(host: 'localhost', username: 'root', password: '', dbname: '');
        $db->connect();
        $results = $db->fetchAll(sql: "SELECT * FROM pessoa WHERE email = '$email' AND  senha = '$senha'");
        $db->disconnect();
        if ($results !== null) {
            echo "\nJá existe um usuário com esse e-mail.";
        } else {
            $db = new Fiscal_DAO(host: 'localhost', username: 'root', password: '', dbname: '');
            $db->connect();
            $db->executeQuery(sql: "INSERT INTO pessoa (identificacao, nome, email, endereco, telefone, data_nascimento, senha) VALUES ('$identificacao', '$nome', '$email', '$endereco', '$telefone', '$data_nascimento', $senha')");
            $db->executeQuery(sql: "INSERT INTO fiscal (identificacao_equip, idPessoa) VALUES ('$identificacao_fiscal', '$identificacao')");
            $db->disconnect();
            echo "Usuário criado com sucesso.";
            header(header: "/WebPages_eLixo_frontend/Tela_login_e-LIXO_BlackBoxAi.html");
        }
    }
}

//------------------FIM DA CLASSE Fiscal----------------//
