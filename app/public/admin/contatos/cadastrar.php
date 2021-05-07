<?php 
include_once('../../../Agenda.php');

try {
    $contato = array();
    // controle
    $contato['nome'] = $_POST['nome'];
    $contato['telefone'] = $_POST['telefone'];
    $contato['ano'] = $_POST['ano'];

    // modelo
    $agenda = new Agenda();
    $id = $agenda->cadastrar($contato);

    // visao
    echo '{"ok": true, "id": ' . $id . '}';
}
catch (Exception $e) {
    echo '{"ok": false, "error": "' . $e . ':' . $e->getMessage() . '"}';
}
