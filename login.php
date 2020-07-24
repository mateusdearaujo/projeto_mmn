<?php
session_start();
require "config.php";

if(!empty($_POST['email']) && !empty($_POST['senha'])) {
    $email = addslashes($_POST['email']);
    $senha = md5(addslashes($_POST['senha']));

    $sql = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email AND senha = :senha");
    $sql->bindValue(":email", $email);
    $sql->bindValue(":senha", $senha);
    $sql->execute();

    if($sql->rowCount() > 0) {
        $sql = $sql->fetch();

        $_SESSION['mmnlogin'] = $sql['id'];

        header("Location: index.php");
    } else {
        $erro = "E-mail e/ou senha inválidos";
    }
} else {
    $erro = "";
}

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
<div class="container">
    <div class="form">
        <form method="POST">
            <h1>Faça seu login!</h1>
            <div class="form-group">
                <label for="email">Digite o seu e-mail</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" required>
                <small class="form-text text-muted">Não compartilhe o seu e-mail com outra pessoa.</small>
            </div>
            <div class="form-group">
                <label for="senha">Digite sua senha</label>
                <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha" required>
            </div>
            <?php if($erro != ""): ?>
                <div class="alert alert-danger">
                    <?php echo $erro; ?>
                </div>
            <?php endif; ?>
            <button type="submit" class="btn btn-primary">Entrar</button>
        </form>
    </div>
</div>
</main>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OG pamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>