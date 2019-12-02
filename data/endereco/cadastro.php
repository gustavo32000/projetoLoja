<?php 
/* Vamos construir os cabeçalhos para o trabalho com a api */

header("Access-Control-Allow-Origin");
header("Content-Type: Aplication/json; charset=utf-8");

#Esse cabeçalho define o método de envio como POST, ou seja, como cadastro
header("Access-Control-Allow-Methods:POST");

#Define o tempo de espera da api. Neste caso é um minuto
header("Access-Control-Max-Age:3600");

include_once "C:\wamp64\www\dbloja\config\database.php";

include_once "C:\wamp64\www\dbloja\domain/endereco.php";

$database = new Database();
$db = $database->getConnection();

$endereco = new Endereco($db);

/* O cliente irá enviar os dados no formato json. porém nós precisamos dos dados no formato php para cadastrar em banco de dados.
Para realizar essa conversão iremos usar o comando json_decode. Assim que o cliente enviar os dados, estes são lidos pela entrada php: e
seu conteúdo é capturado e convertido para o formato php. */
$data = json_decode(file_get_contents("php://input"));

#Verificar se os campos estão com dados.
if(!empty($data->bairro) && !empty($data->complemento) && !empty($data->cep) && !empty($data->logradouro) && !empty($data->numero)){
    $endereco->bairro = $data->bairro;
    $endereco->complemento = $data->complemento;
    $endereco->cep = $data->cep;
    $endereco->logradouro =$data->logradouro;
    $endereco->numero = $data->numero;
    
    if($endereco->cadastro()){
        header("HTTP/1.0 201");
        echo json_encode(array("mensagem"=>"Endereço cadastrado com sucesso!"));
    }
    else{
        header("HTTP/1.0 400");
        echo json_encode(array("mensagem"=>"Não foi possível cadastrar."));
    }
}

else{
    header("HTTP/1.0 400");
    echo json_encode(array("mensagem"=>"Você precisa passar todos os dados para cadastrar"));
}
?>