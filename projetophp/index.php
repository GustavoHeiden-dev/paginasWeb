<?php include('Db.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Alunos</title>
    <style>
        .container{
            font-family: Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        input{
             padding: 10px 15px;
        }
        button{
          background-color: #28a745;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

    </style>
</head>
<body>
    <div class="container">
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
                <a href='excluir.php?id={$t['id']}'>Excluir</a>
              </li>";
    }
    echo "</ul>";
    ?>
    </div>
</body>
</html>
