<?php

function conectar() {
    $user = $_ENV['MYSQL_USER'];
    $pass = $_ENV['MYSQL_PASSWORD'];
    $conexao = new PDO('mysql:host=' . $_ENV['MYSQL_HOST'] . ';dbname=' . $_ENV['MYSQL_DATABASE'], $user, $pass);
    return $conexao;
}
