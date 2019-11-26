<?php

/* Este cabeçalho permite o acesso a listagem de usuários com diversas origens
por isso estamos usando o *(asterisco) para essa permissão que será para http,https,file,ftp */
header("Access-Control-Allow-Origin:*");

/* Vamos definir qual será o formato de dados que o usuário irá enviar a api.
Este formato será do tipo JSON(Javascript On Notation) */

header("Content-Type: application/json;charset=utf-8");

#Abaixo estamos incluindo o arquivo database.php que possui a classe Database com a conexão com o banco de dados.
include_once "C:\wamp64\www\dbloja\config\database.php";

/* O arquivo usuario.php foi incluído para que a classe Usuario fosse utilizada. 
Vale lembrar que esta classe possui o CRUD para o usuário. */
include_once "C:\wamp64\www\dbloja\domain\usuario.php";

/* Criamos um objeto chamado $database. É uma instância da classe Database.
Quando usamos o termo new, estamos criando uma instância, ou seja, um objeto da classe Database.
Isso nos dará acesso a todos os dados da classe Database.  */

$database = new Database();

/* Executamos a função getConnection que estabelece a conexão com o banco de dados.
E retorna essa conexão realizada para a variável $db */

$db = $database->getConnection();

/* Instância da classe Usuario e, portanto, criação do objeto chamado $usuario.
Isso fará com que todas as funções que estão dentro da classe Usuario sejam transferidas para o objeto $usuario.
Durante a instância foi passado o parâmetro a variável $db que possui a comunicação com o banco de dados e também a variável conexao. 
Utilizada para o uso dos comandos de CRUD */

$usuario = new Usuario($db);

/* A variável $stmt(Statement->sentença) foi criada para guardar o retorno da cunsulta que está na função listar. 
Dentro da função listar() temos uma consulta no formato sql que seleciona todos os usuários("Select * from usuario")*/

$stmt = $usuario->listar();

/* Se a consulta retornar uma quantidade de linhas maior que 0(Zero), então será construido um array com os dados dos usuarios.
Caso contrário será exibida uma mensagem de que não há usuários cadastrados*/

if($stmt->rowCount() > 0){

/* Para organizar os usurios cadastrados em banco e exibí-los em tela,
 foi criado uma array com o nome de saida e assim guardará todos usuarios */
    $usuario_arr["saida"] = array();

    /* A estrutura while(enquanto) realiza a busca e todos os usuários cadastrados 
    até chegar ao final da tabela e trás os dados para fetch array organizar em formato de array.
    Assim será mais fácil de adicionar no array de usuarios para ser apresentado ao usuario. */

    while($linha = $stmt->fetch(PDO::FETCH_ASSOC)){

        /* O comando extract é capaz de separar de forma mais simples os campos da tabela usuario */

        extract ($linha);

        /* Pegar um campo por vez do comando extract e adicionar em um array de itens,
        pois será assim que os usuarios serão tratados, um usuário por vez com seus respectivos dados. */
        $array_item = array(
            "id"=>$id,
            "nomeusuario"=>$nomeusuario,
            "senha"=>$senha,
            "foto"=>$foto    
        );

        /* Pegar um item gerado pelo array_item e adicionar a saida, que também é um array.
        array_push é um comando em que você pode adicionar algo em um array. 
        Assim estamos adicionando ao usuario_arr[saida] um item que é um usuario com seus respectivos dados. */

        array_push($usuario_arr["saida"],$array_item);

        /* O comando header(cabeçalho) responde  via HTTP o status code 200 que representa sucesso na consulta de dados. */            

    }
    header("HTTP/1.0 200");

    /* Pegamos o array usuario_arr que foi construído em php com os dados dos usuarios 
    e convertemos para o formato json para exibir ao cliente requisitante */

    echo json_encode($usuario_arr);
}
else{
    /* O comando header(cabeçalho) responde ao cliente o status code 400(badrequest) caso não haja usuários cadastrados no banco.
    Junto ao status code será exibida a mensagem "mensagem: Não há registro de usuários" que será mostrada por meio do comando json_encode */
    header("HTTP/1.0 400");
    echo json_encode(array("mensagem"=>"Não há registro de usuários"));
}
?>