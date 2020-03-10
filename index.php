<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eStracta</title>
</head>
<body>
    <?php
    
    require("./vendor/autoload.php");
    
    use Goutte\Client as GoutteClient;
    use GuzzleHttp\Client as GuzzleClient;

    $guzzleClient = new GuzzleClient(array(
        'timeout' => 60,
    ));    
    $goutteClient = new GoutteClient();    
    $goutteClient->setClient($guzzleClient);

    $crawler = $goutteClient->request('GET', 'http://www.guiatrabalhista.com.br/guia/salario_minimo.htm');

    $table = $crawler->filter('table[width=1050]')->filter('tr')->each(function ($tr, $i) {          
        return $tr->filter('td')->each(function ($td, $i) {
            return trim($td->text());
        });
    });
    array_shift($table);

    // echo json_encode($table); 
    echo '<pre>';
    
    print_r($table); 
    
    echo '</pre>';
    ?>
</body>
</html>