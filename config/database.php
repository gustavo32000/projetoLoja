<?php
/* A classe database irá permitir a comunicação com o banco de dados. Nesta classe teremos a string de conexão com o banco, bem como:
    -Nome de usuário: "root"
    -Senha: "" -> Vazio neste caso
    -Banco de dados: dbloja
    -Porta de comunicação: 3306
    -Servidor: localhost ou IP
E uma variável para a conexão com o banco que será usada em outros arquivos e, portanto, será   será deckarada com o modificador public
*/
class Database{

    public $conexao;
    public function getConnection(){
        try{
            $conexao = new PDO("mysql:host=localhost;port=3306;dbname=dbloja","root","");
            #definir tipo de caracter para o banco como utf8 que é o caracter acentuado
            $conexao->exec("set name utf8");
        } 
        catch(PDOException $e){
            echo "Erro ao tentar estabelecer a conexão com o banco de dados. ".$e->getMessage();
        }
        return $conexao;
    }
}


?>