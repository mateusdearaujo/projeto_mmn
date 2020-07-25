<?php
function listar($id, $limite) {
    $lista = array();
    global $pdo;

    $sql = $pdo->prepare("SELECT * FROM usuarios WHERE id_pai = :id");
    $sql->bindValue(":id", $id);
    $sql->execute();

    if($sql->rowCount() > 0) {
        $lista = $sql->fetchAll(PDO::FETCH_ASSOC);

        foreach($lista as $chave => $usuario) {
            $lista[$chave]['filhos'] = array();

            if($limite > 0) {
                $lista[$chave]['filhos'] = listar($usuario['id'], $limite - 1);
            }
        }
    }
    return $lista;
}

function exibir($array) {
    echo "<ul class='list-group'>";
    foreach($array as $usuario) {
        echo  "<li class='list-group-item'>";
        echo $usuario['nome']." (".count($usuario['filhos'])." cadastros diretos)";
        if(count($usuario['filhos'] > 0)) {
            exibir($usuario['filhos']);
        }
        echo "</li>";
    }
    echo "</ul>";
}