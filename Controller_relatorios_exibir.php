<?php
// Classes de Controle de Requisição e Resposta do navegador em PHP
require_once("Model/Model.php");
$location = $_POST['location'];
//Programa em PHP que permite a busca pela localização, via dispositivo do cliente.
//Aqui, você pode usar a API do Google Maps para obter a latitude e longitude da localização.
$api_key = "";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://maps.googleapis.com/maps/api/geocode/json?address=$location&key=$api_key");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);
// Convertendo a resposta em um objeto JSON
$data = json_decode($response, true);
// Verificando se a resposta foi bem-sucedida 
if ($data['status'] == 'OK') {
    // Pegando a latitude e longitude da localização
    $latitude = $data['results'][0]['geometry']['location']['lat'];
    $longitude = $data['results'][0]['geometry']['location']['lng'];
    // Criando um objeto de localização
    $location = new Location();
    $location->setLatitude($latitude);
    $location->setLongitude($longitude);
}
class Requisicao
{
    public function pesquisaPorPontosDeColeta($origem, $location, $identificacao_coleta, $Dados_relatorio, $status_coleta, $data_coleta, $hora_coleta, $enderecoColeta, $CEP, $telefone_equipe_resp, $nome_equipe_resp, $capacidadeMaxima, $tipoLixo, $quantidade, $valorTotal): mixed
    {
        $pt = new ColetaDomiciliar_Amb_Trab($identificacao_coleta, $Dados_relatorio, $status_coleta, $data_coleta, $hora_coleta, $enderecoColeta, $CEP, $telefone_equipe_resp, $nome_equipe_resp, $capacidadeMaxima, $$tipoLixo, $quantidade, $valorTotal);
        $pt->pesquisarPontosDeColeta(origem: $origem, location: $location);
        return $pt;
    }
}

$req = new Requisicao();
$data = $req->pesquisaPorPontosDeColeta($origem, $location, $identificacao_coleta, $Dados_relatorio, $status_coleta, $data_coleta, $hora_coleta, $enderecoColeta, $CEP, $telefone_equipe_resp, $nome_equipe_resp, $capacidadeMaxima, $tipoLixo, $quantidade, $valorTotal);
