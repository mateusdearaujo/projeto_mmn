<?php
session_start();
require "config.php";
require "funcoes.php";
global $pdo;

$sql = $pdo->query("SELECT id FROM usuarios");
$sql->execute();
$usuarios = array();

if($sql->rowCount() > 0) {
    $usuarios = $sql->fetchAll(PDO::FETCH_ASSOC);
    foreach($usuarios as $chave => $usuario) {
        $usuarios[$chave]['filhos'] = calcular_cadastros($usuario['id'], $limite);
    }
}

$sql = $pdo->query("SELECT * FROM patentes ORDER BY min DESC");
$sql->execute();
$patentes = array();

if($sql->rowCount() > 0) {
    $patentes = $sql->fetchAll();
}

foreach($usuarios as $usuario) {
    foreach($patentes as $patente) {
        if(intval($usuario['filhos']) >= intval($patente['min'])) {
            $sql = $pdo->prepare("UPDATE usuarios set patente = :patente WHERE id = :id");
            $sql->bindValue(':patente', $patente['id']);
            $sql->bindValue(":id", $usuario['id']);
            $sql->execute();
            break;
        }
    }
}



















