<?php
include_once('../Agenda.php');

$agenda = new Agenda();
$contatos = $agenda->listar();
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
foreach ($contatos as $contato) {
?>
    <article>
        <h1><?php echo $contato['nome']; ?></h1>
        <span>Telefone: <?php echo $contato['telefone']; ?></span>
        <span>Desde <?php echo $contato['ano']; ?></span>
    </article>
<?php
}
?>
</section>
</body>
</html>
