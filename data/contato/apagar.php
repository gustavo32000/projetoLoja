<?php 
/* Vamos construir os cabeçalhos para o trabalho com a api */

header("Access-Control-Allow-Origin");
header("Content-Type: Aplication/json; charset=utf-8");

#Esse cabeçalho define o método de envio como DELETE, ou seja, como deletar
header("Access-Control-Allow-Methods:DELETE");

#Define o tempo de espera da api. Neste caso é um minuto
header("Access-Control-Max-Age:3600");

include_once "C:\wamp64\www\dbloja\config\database.php";

include_once "C:\wamp64\www\dbloja\domain\contato.php";

$database = new Database();
$db = $database->getConnection();

$contato = new Contato($db);

/* O cliente irá enviar os dados no formato json. porém nós precisamos dos dados no formato php para apagar em banco de dados.
Para realizar essa conversão iremos usar o comando json_decode. Assim que o cliente enviar os dados, estes são lidos pela entrada php: e
seu conteúdo é capturado e convertido para o formato php. */
$data = json_decode(file_get_contents("php://input"));

#Verificar se os campos estão com dados.
if(!empty($data->id)){
    $contato->id = $data->id;
    
    if($contato->apagar()){
        header("HTTP/1.0 200");
        echo json_encode(array("mensagem"=>"Contato deletado com sucesso!"));
    }
    else{
        header("HTTP/1.0 400");
        echo json_encode(array("mensagem"=>"Não foi possível apagar o contato."));
    }
}

else{
    header("HTTP/1.0 400");
    echo json_encode(array("mensagem"=>"Você precisa passar todos os dados para apagar o contato."));
}
?>