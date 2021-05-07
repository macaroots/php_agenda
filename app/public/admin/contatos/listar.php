<?php
include_once('../../../Agenda.php');

// modelo
$agenda = new Agenda();
$contatos = $agenda->listar();

// visao
echo json_encode($contatos);
