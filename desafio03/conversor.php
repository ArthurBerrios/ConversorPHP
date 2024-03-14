<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">    
    
    <title>Document</title>
</head>
<body>
    <?php
    $inicio = date("m-d-Y", strtotime("-7 days")); // data atual - 7 dias
    $fim = date("m-d-Y"); // data atual
    $url = 'https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoDolarPeriodo(dataInicial=@dataInicial,dataFinalCotacao=@dataFinalCotacao)?@dataInicial=\''. $inicio . '\'&@dataFinalCotacao=\'' . $fim . '\'&$top=100&$skip=0&$format=json&$select=cotacaoCompra,dataHoraCotacao';

    $dados = json_decode(file_get_contents($url),   true);  //trata dados em json/ json= formato que troca dados de forma simples. 
                      //vai pegar o conteudo baseado na url  
    
    $cotacao = $dados["value"][0]["cotacaoCompra"];
    $valor = $_GET["reais"];
    $resultado = $valor / $cotacao;
    $padrao = numfmt_create("us",NumberFormatter::CURRENCY);
    echo "<p>Seus "  . numfmt_format_currency($padrao, $valor, "BRL") . " equivalem a " . numfmt_format_currency($padrao, $resultado,"USD") . "<p>";
?> 
<button onclick="javascripit:history.go(-1)">Voltar</button>

</body>
</html>