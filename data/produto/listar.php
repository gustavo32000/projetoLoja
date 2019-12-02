<?php

/* Este cabeçalho permite o acesso a listagem de produtos com diversas origens
por isso estamos usando o *(asterisco) para essa permissão que será para http,https,file,ftp */
header("Access-Control-Allow-Origin:*");

/* Vamos definir qual será o formato de dados que o produto irá enviar a api.
Este formato será do tipo JSON(Javascript On Notation) */

header("Content-Type: application/json;charset=utf-8");

#Abaixo estamos incluindo o arquivo database.php que possui a classe Database com a conexão com o banco de dados.
include_once "C:\wamp64\www\dbloja\config\database.php";

/* O arquivo produto.php foi incluído para que a classe Produto fosse utilizada. 
Vale lembrar que esta classe possui o CRUD para o produto. */
include_once "C:\wamp64\www\dbloja\domain/produto.php";

/* Criamos um objeto chamado $database. É uma instância da classe Database.
Quando usamos o termo new, estamos criando uma instância, ou seja, um objeto da classe Database.\e
Isso nos dará acesso a todos os dados da classe Database.  */

$database = new Database();

/* Executamos a função getConnection que estabelece a conexão com o banco de dados.
E retorna essa conexão realizada para a variável $db */

$db = $database->getConnection();

/* Instância da classe Produto e, portanto, criação do objeto chamado $produto.
Isso fará com que todas as funções que estão dentro da classe Produto sejam transferidas para o objeto $produto.
Durante a instância foi passado o parâmetro a variável $db que possui a comunicação com o banco de dados e também a variável conexao. 
Utilizada para o uso dos comandos de CRUD */

$produto = new Produto($db);

/* A variável $stmt(Statement->sentença) foi criada para guardar o retorno da cunsulta que está na função listar. 
Dentro da função listar() temos uma consulta no formato sql que seleciona todos os produtos("Select * from produto")*/

$stmt = $produto->listar();

/* Se a consulta retornar uma quantidade de linhas maior que 0(Zero), então será construido um array com os dados dos produtos.
Caso contrário será exibida uma mensagem de que não há produtos cadastrados*/

if($stmt->rowCount() > 0){

/* Para organizar os usurios cadastrados em banco e exibí-los em tela,
 foi criado uma array com o nome de saida e assim guardará todos produtos */
    $produto_arr["saida"] = array();

    /* A estrutura while(enquanto) realiza a busca e todos os produtos cadastrados 
    até chegar ao final da tabela e trás os dados para fetch array organizar em formato de array.
    Assim será mais fácil de adicionar no array de produtos para ser apresentado ao produto. */

    while($linha = $stmt->fetch(PDO::FETCH_ASSOC)){

        /* O comando extract é capaz de separar de forma mais simples os campos da tabela produto */

        extract ($linha);

        /* Pegar um campo por vez do comando extract e adicionar em um array de itens,
        pois será assim que os produtos serão tratados, um produto por vez com seus respectivos dados. */
        $array_item = array(
            "id"=>$id,
            "nome"=>$nome,
            "descricao"=>$descricao,
            "preco"=>$preco,
            "imagem1"=>$imagem1,
            "imagem2"=>$imagem2,
            "imagem3"=>$imagem3,
            "imagem4"=>$imagem4
        );

        /* Pegar um item gerado pelo array_item e adicionar a saida, que também é um array.
        array_push é um comando em que você pode adicionar algo em um array. 
        Assim estamos adicionando ao produto_arr[saida] um item que é um produto com seus respectivos dados. */

        array_push($produto_arr["saida"],$array_item);

        /* O comando header(cabeçalho) responde  via HTTP o status code 200 que representa sucesso na consulta de dados. */            

    }
    header("HTTP/1.0 200");

    /* Pegamos o array produto_arr que foi construído em php com os dados dos produtos 
    e convertemos para o formato json para exibir ao cliente requisitante */

    echo json_encode($produto_arr);
}
else{
    /* O comando header(cabeçalho) responde ao cliente o status code 400(badrequest) caso não haja produtos cadastrados no banco.
    Junto ao status code será exibida a mensagem "mensagem: Não há registro de produtos" que será mostrada por meio do comando json_encode */
    header("HTTP/1.0 400");
    echo json_encode(array("mensagem"=>"Não há registro de produtos"));
}
?>