<html>
<head>
    <meta charset="utf-8" />
</head>
<body>
<?php
if (isset($_GET['erro'])) {
?>
    <div>Usuário ou senha inválidos!</div>
<?php
}
?>
    <form method="POST" action="logar.php">
        <label>
            Usuário: <input name="usuario" />
        </label>
        <label>
            Senha: <input name="senha" type="password" />
        </label>
        <button>Entrar</button>
    </form>
</body> 
</html>
