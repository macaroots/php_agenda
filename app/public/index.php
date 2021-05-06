<?php
$user = 'teste';
$pass = '123';
$conexao = new PDO('mysql:host=mysql;dbname=agenda', $user, $pass);
$sql = "SELECT * FROM contatos";
$consulta = $conexao->prepare($sql);
?>
<html>
<head>
    <meta charset="utf-8" />
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="index.php">Início</a></li>
            <li><a href="procurar.php">Procurar</a></li>
            <li><a href="login.php">Adminstração</a></li>
        </ul>
    </nav>
</header>
<section>
    <h1>Agenda Super Legal</h1>
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
