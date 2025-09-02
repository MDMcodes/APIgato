<?php
// Headers para o PHP conseguir rodar em versões mais antigas do easyphp
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Headers: *");

// Array que vai ser mandado para o JS com os dados
$response = array(
    "success" => false,
    "image" => "https://i.ytimg.com/vi/6-Ekj41gMII/hqdefault.jpg"
);

// Conecta com a API do The Cat API
$url = "https://api.thecatapi.com/v1/images/search";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
$apiResponse = curl_exec($ch);
$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// Checa se a conexão com a API foi um sucesso
if($httpcode == 200 && $apiResponse !== false){
    // Coloca os dados da API em forma de Json para o código usar
    $catData = json_decode($apiResponse, true);

    // Verifica se os dados estão no formato correto
    if(is_array($catData) && !empty($catData) && isset($catData[0]['url'])){
        // Coloca os dados do Json em variáveis
        $catImage = $catData[0]['url'];

        // Atualiza o array com os dados que vamos usar
        $response = array(
            "success" => true,
            "image" => $catImage
        );
    }
}

// Manda os dados para o JS
echo json_encode($response);
?>