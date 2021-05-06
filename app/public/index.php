<?php
if (isset($_POST['nome'])) {
    $nome = '%' . $_POST['nome'] . '%';
}
else {
    $nome = '%';
}

$user = 'teste';
$pass = '123';
$conexao = new PDO('mysql:host=mysql;dbname=agenda', $user, $pass);
$sql = "SELECT * FROM contatos WHERE nome like ?";
$consulta = $conexao->prepare($sql);
$consulta->bindParam(1, $nome);
?>
<html>
<head>
    <meta charset="utf-8" />
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="login.php">Adminstração</a></li>
        </ul>
    </nav>
</header>
<section>
    <h1>Agenda</h1>
    <form method="POST">
        <label>
            Nome: <input name="nome" />
        </label>
        <button>Procurar</button>
    </form>
<?php
if ($consulta->execute()) {
    while ($contato = $consulta->fetch(PDO::FETCH_ASSOC)) {
?>
    <article>
        <h1><?php echo $contato['nome']; ?></h1>
        <span>Telefone: <?php echo $contato['telefone']; ?></span>
        <span>Desde <?php echo $contato['ano']; ?></span>
    </article>
<?php
    }
}
?>
</section>
</body>
</html>
