<?php
session_start();
require "config.php";
require "funcoes.php";

if(empty($_SESSION['mmnlogin'])) {
   header("Location: login.php");
   exit;
}

$id = $_SESSION['mmnlogin'];

$sql = $pdo->prepare("SELECT nome FROM usuarios WHERE id = :id");
$sql->bindValue(":id", $id);
$sql->execute();

if($sql->rowCount() > 0) {
    $sql = $sql->fetch();
    $nome = $sql['nome'];
} else {
    header("Location: login.php");
    exit;
}

$lista = listar($id, $limite);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Projeto Marketing Multinível</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<main>
<div class="container home">
    <div id="conteudo">
        <h1>Sistema de Marketing Multinível</h1>
        <span>Usuário conectado: <?php echo $nome; ?></span>
    </div>
    <div>
        <h2>Lista de usuários cadastrados</h2>
        <?php exibir($lista); ?>
    </div>
    <div id="btns">
        <a class="btn btn-primary" href="cadastro.php">Cadastrar novo usuário</a>
        <a class="btn btn-primary" href="sair.php">Sair</a>
    </div>
</div>
</main>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OG pamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>