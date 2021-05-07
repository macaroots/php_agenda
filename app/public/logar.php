<?php
include_once('../Agenda.php');
 
$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

$agenda = new Agenda();
$contato = $agenda->autenticar($usuario, $senha);

if ($usuario != null) {
    $pagina = 'admin';
}
else {
    $pagina = 'login.php?erro=true';
}
header('location: ' . $pagina);
