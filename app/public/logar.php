<?php
 
$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

$user = 'test';
$pass = '123';
$conexao = new PDO('mysql:host=mysql;dbname=agenda', $user, $pass);
$sql = "SELECT * FROM contatos WHERE nome=? and telefone=?";
$consulta = $conexao->prepare($sql);
$consulta->bindParam(1, $usuario);
$consulta->bindParam(2, $senha);

$ok = false;
if ($consulta->execute()) {
    if ($contato = $consulta->fetch(PDO::FETCH_ASSOC)) {
        $ok = true;
    }
}

if ($ok) {
    $pagina = 'admin';
}
else {
    $pagina = 'login.php?erro=true';
}
header('location: ' . $pagina);
