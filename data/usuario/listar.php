<?php

/* Este cabeçalho permite o acesso a listagem de usuários com diversas origens
por isso estamos usando o *(asterisco) para essa permissão que será para http,https,file,ftp */
header("Access-Control-Allow-Origin:*");

/* Vamos definir qual será o formato de dados que o usuário irá enviar a api. Este formato será do tipo JSON(Javascript On Notation) */

header("Content-Type: application/json;charset=utf-8");

include_once "C:\wamp64\www\dbloja\domain\usuario.php";
include_once "C:\wamp64\www\dbloja\domain\database.php";

$database = new Database();
$db = $database->getConnection();

$usuario = new Usuario($db);
?>