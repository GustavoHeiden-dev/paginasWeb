<?php include('Db.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Alunos</title>
</head>
<body>
    <h1>Cadastro de Alunos</h1>

    <form action="" method="POST">
        <input type="text" name="nome" placeholder="Nome aluno" required>
        <input type="text" name="curso" placeholder="Curso" required>
        <button name="adicionar" type="submit">Adicionar</button>
    </form>

    <?php
    if(isset($_POST["adicionar"])){
        $nome = $_POST["nome"];
        $curso = $_POST["curso"];

        $stmt = $conn->prepare("INSERT INTO alunos (Nome, Curso) VALUES (?, ?)");
        $stmt->bind_param("ss", $nome, $curso);
        $stmt->execute();
        header("Location: index.php"); 
        exit;
    }
    $resultado = $conn->query("SELECT * FROM alunos ORDER BY id DESC");

    echo "<ul>";
    while($t = $resultado->fetch_assoc()){
        echo "<li>{$t['Nome']} - {$t['Curso']} 
                <a href='editar.php?id={$t['id']}'>Editar</a> | 
                <a href='delete.php?id={$t['id']}'>Excluir</a>
              </li>";
    }
    echo "</ul>";
    ?>
</body>
</html>
