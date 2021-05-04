<?php 
try {
    $contato = array();
    $contato['nome'] = $_POST['nome'];
    $contato['telefone'] = $_POST['telefone'];
    $contato['ano'] = $_POST['ano'];

    $user = 'test';
    $pass = '123';
    $conexao = new PDO('mysql:host=mysql;dbname=agenda', $user, $pass);
    $st = $conexao->prepare("INSERT INTO contatos (nome, telefone, ano) VALUES (?, ?, ?)");
    $st->bindParam(1, $contato['nome']);
    $st->bindParam(2, $contato['telefone']);
    $st->bindParam(3, $contato['ano']);
    $st->execute();
    $id = $conexao->lastInsertId();

    echo '{"ok": true, "id": ' . $id . '}';
}
catch (Exception $e) {
    echo '{"ok": false, "error": "' . $e . ':' . $e->getMessage() . '"}';
}
