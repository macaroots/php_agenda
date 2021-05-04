<?php

$user = 'test';
$pass = '123';
$conexao = new PDO('mysql:host=mysql;dbname=agenda', $user, $pass);
$consulta = $conexao->prepare("SELECT * FROM contatos");
$contatos = array();
if ($consulta->execute()) {
    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
        $contatos[] = $linha;
    }
}

echo json_encode($contatos);
