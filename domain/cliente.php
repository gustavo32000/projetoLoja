<?php

class Cliente{
    public $id;
    public $nome;
    public $cpf;
    public $id_endereco;
    public $id_contato;
    public $id_usuario;

    


    public function __construct($db){
        $this->conexao = $db;
    }



    /*
    Função listar para selecionar todos os cliente cadastrados no banco de dados. 
    Essa função retorna uma lista com todos os dados.
    */
    public function listar(){
        #Seleciona todos os campos da tabela cliente
        $query = "select * from cliente";
        /*
         Foi criada a variavel stmt(Statment -> Sentença) para guardar a preparacao da consulta 
         select que será executada posteriomente.
         */
        $stmt = $this->conexao->prepare($query);
        #execução da consulta e guarda de dados na variavel stmt 

        $stmt->execute();
        #retorna os dados do usuário a camada data.

        return $stmt;
    }






    public function pesquisar_id(){
        #Seleciona todos os campos da tabela cliente
        $query = "select * from cliente where id=?";
        /*
         Foi criada a variavel stmt(Statment -> Sentença) para guardar a preparacao da consulta 
         select que será executada posteriomente.
         */
        $stmt = $this->conexao->prepare($query);

        $stmt->bindParam(1,$this->id);
        #execução da consulta e guarda de dados na variavel stmt 

        $stmt->execute();
        #retorna os dados do usuário a camada data.

        return $stmt;
    }


    public function pesquisar_nome(){
        #Seleciona todos os campos da tabela cliente
        $query = "select * from cliente where nome like ?";
        /*
         Foi criada a variavel stmt(Statment -> Sentença) para guardar a preparacao da consulta 
         select que será executada posteriomente.
         */
        $stmt = $this->conexao->prepare($query);

        $stmt->bindParam(1,$this->nome);
        #execução da consulta e guarda de dados na variavel stmt 

        $stmt->execute();
        #retorna os dados do usuário a camada data.

        return $stmt;
    }

 

    /*
    Função para cadastrar os clientes no banco de dados 
    */
    public function cadastro(){
        $query = "insert into cliente set nome=:n, cpf=:c, id_endereco=:e, id_contato=:t, id_usuario=:u";

        $stmt = $this->conexao->prepare($query);

        /*
        Foi utilizada 2 funçoes para tratar os dados que estao vindo do usuario 
        para api.
        strip_tags-> trata os dados em seus formatos inteiro, double ou decimal 
        htmlspecialchar-> retira as aspas e os 2 pontos que vem do formato 
        json para cadastrar em banco. 
        */

        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->cpf = htmlspecialchars(strip_tags($this->cpf));
        $this->id_endereco = htmlspecialchars(strip_tags($this->id_endereco));
        $this->id_contato  = htmlspecialchars(strip_tags($this->id_contato));
        $this->id_usuario  = htmlspecialchars(strip_tags($this->id_usuario));
        

    

        $stmt->bindParam(":n",$this->nome);
        $stmt->bindParam(":c",$this->cpf);
        $stmt->bindParam(":e",$this->id_endereco);
        $stmt->bindParam(":t",$this->id_contato);
        $stmt->bindParam(":u",$this->id_usuario);
        

        if($stmt->execute()){
            return true;
        }
        else{
            
            return false;
        }

    }

    public function alterarcliente(){

        $query = "update cliente set nome=:n, cpf=:c, id_endereco=:e, id_contato=:t, id_usuario=:u where id=:i";

        $stmt= $this->conexao->prepare($query);

        $stmt->bindParam(":i",$this->id);
        $stmt->bindParam(":n",$this->nome);
        $stmt->bindParam(":c",$this->cpf);
        $stmt->bindParam(":e",$this->id_endereco);
        $stmt->bindParam(":t",$this->id_contato);
        $stmt->bindParam(":u",$this->id_usuario);

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }

    public function apagar(){
        $query = "delete from cliente where id=?";

        $stmt=$this->conexao->prepare($query);

        $stmt->bindParam(1,$this->id);

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }



}

?>