<?php
include('../Sistema_e_LIXO_backend/Model/Model.php');
$relatorio = new Relatorio(identificacao_relatorio: 0, dataGeracao: null, nome: '', tipoRelatorio: '', conteudo: '', capacidadeBytesArquivo: 0, proprietario: '', tipoDoArquivoRelatorio: '');
$relatorio->visualizarRelatorio($identificacao_relatorio, $dataGeracao, $nome, $tipo, $conteudo, $capacidadeBytes, $proprietario, $tipoArquivo, $idUsuario_cliente, $idAdministrador);
?>
<?php
include('../Sistema_e_LIXO_backend/Model/Model.php');
$relatorio = new Relatorio(identificacao_relatorio: 0, dataGeracao: null, nome: '', tipoRelatorio: '', conteudo: '', capacidadeBytesArquivo: 0, proprietario: '', tipoDoArquivoRelatorio: '');
// Add logs
$logFile = 'logs/relatorio_logs.txt';
$logMessage = 'Relatório gerado com sucesso!';
file_put_contents(filename: $logFile, data: $logMessage . PHP_EOL, flags: FILE_APPEND);

$relatorio->visualizarRelatorio($identificacao_relatorio, $dataGeracao, $nome, $tipo, $conteudo, $capacidadeBytes, $proprietario, $tipoArquivo, $idUsuario_cliente, $idAdministrador);
$Array_result_relatorios = array_diff_assoc(array: [$relatorio]);

if ($_POST['submit']) {
    //Código em PHP para imprimir  o relatório
    $relatorio = new Relatorio(identificacao_relatorio: 0, dataGeracao: null, nome: '', tipoRelatorio: '', conteudo: '', capacidadeBytesArquivo: 0, proprietario: '', tipoDoArquivoRelatorio: '');
    $relatorio->visualizarRelatorio($identificacao_relatorio, $dataGeracao, $nome, $tipo, $conteudo, $capacidadeBytes, $proprietario, $tipoArquivo, $idUsuario_cliente, $idAdministrador);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar o Relatorio da Coleta de Lixo Eletronico</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>

<body>

    <header>
        <nav class="navbar" data-aos="zoom-in-down">
            <h2 class="logo"><a href="#about">E-LIXO</a></h2>
            <input type="checkbox" id="menu-toggler">
            <label for="menu-toggler" id="hamburger-btn">
                <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24" fill="white" width="24px" height="24px">
                    <path d="M0 0H24v24H0z" fill="none"></path>
                    <path d="M3 18h18v-2H3V2zm0-5h18V11H3v2zm0-7v2h18V6H3z"></path>
                </svg>
            </label>
            <ul class="all-links">
                <li><a href="/Simple Responsive Website Using Html Css With Source Code/index.html#home">Home</a></li>
                <li><a href="/Simple Responsive Website Using Html Css With Source Code/index.html#services">Serviços</a></li>
                <li><a href="/Simple Responsive Website Using Html Css With Source Code/index.html#galeria">Galeria</a></li>
                <li><a href="/Simple Responsive Website Using Html Css With Source Code/index.html#about">Sobre Nós</a></li>
                <li><a href="/Simple Responsive Website Using Html Css With Source Code/index.html#blog_newspaper">Blog</a></li>
            </ul>
        </nav>
    </header>

    <main id="main_relatorio">
        <section class="homepage" id="home_relatorio">
            <div class="content relatorioContainer" data-aos="zoom-in-down">
                <div class="text">
                    <!-- <h1>E-LIXO Visualização de Relatório de Coleta de Lixo</h1>
                    <p>Não há relatório no momento.</p>
                    <p>Gostaria de Solicitar um Agendamento na tela de Serviços?</p> -->
                </div>
                <div class="text RelatorioDigital">
                    <h1 id="Titulo_Relatorio">E-LIXO Visualização de Relatório de Coleta de Lixo</h1>
                    <br>
                    <table class="table table-striped-columns caption-top table-responsive" id="table">
                        <caption>Relatório de Coleta de Lixo</caption>
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nome do Relatório</th>
                                <th scope="col">Data e Hora da Coleta</th>
                                <th scope="col">Tipo de Relatório</th>
                                <th scope="col">Proprietário</th>
                                <th scope="col">Conteúdo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($relatorio != null) {
                                foreach ($relatorio as $valor) { ?>
                                    <tr>
                                        <th scope="row"><?php echo ($valor->getIdentificacao_relatorio()) ?></th>
                                        <td><?php echo ($valor->getNome_relatorio()) ?></td>
                                        <td><?php echo ($valor->getDataGeracao_relatorio()) ?></td>
                                        <td><?php echo ($valor->getTipoRelatorio()) ?></td>
                                        <td><?php echo ($valor->getpProprietario()) ?></td>
                                        <td><?php echo ($valor->getConteudo()) ?></td>
                                    </tr>
                            <?php }
                            } ?>
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-success" id="download_btn" type="submit">Download Relatório</button>
                    <a href="/Simple Responsive Website Using Html Css With Source Code/index.html#services" id="btn_services">Serviços</a>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div>
            <span>Copyright © 2024 All Rights Reserved</span>
            <span class="link">
                <a href="/Simple Responsive Website Using Html Css With Source Code/index.html#home">Home</a>
                <a href="/Simple Responsive Website Using Html Css With Source Code/index.html#services">Serviços</a>
            </span>
        </div>
    </footer>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>
<script>
    // Fazer o download do arquivo
    download_btn = document.querySelector("#download_btn")
    download_btn.addEventListener("click", function() {
        var table = document.querySelector("#table");
        var html = table.outerHTML;
        var blob = new Blob([html], {
            type: "application/vnd.ms-excel"
        });
        var url = URL.createObjectURL(blob);
        var a = document.createElement("a");
        a.href = url;
        table.print();
        window.print();
    });
</script>

</html>