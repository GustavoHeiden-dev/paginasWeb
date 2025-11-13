<?php
include('Db.php'); 


if(!isset($_GET['id']) || empty($_GET['id'])){
    die("Aluno não encontrado"); 
}

$id = $_GET['id'];


$stmt = $conn->prepare("SELECT Nome, Curso FROM alunos WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows == 0){
    die("Aluno não encontrado");
}

$aluno = $result->fetch_assoc();


if(isset($_POST['editar'])){
    $nome = $_POST['nome'];
    $curso = $_POST['curso'];

    $stmt = $conn->prepare("UPDATE alunos SET Nome = ?, Curso = ? WHERE id = ?");
    $stmt->bind_param("ssi", $nome, $curso, $id);
    $stmt->execute();

   
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Aluno</title>
</head>
<body>
    <h1>Editar Aluno</h1>
    <form action="" method="POST">
        <input type="text" name="nome" value="<?= htmlspecialchars($aluno['Nome']); ?>" required>
        <input type="text" name="curso" value="<?= htmlspecialchars($aluno['Curso']); ?>" required>
        <button type="submit" name="editar">Salvar Alterações</button>
    </form>
    <br>
    <a href="index.php">Voltar</a>
</body>
</html>
