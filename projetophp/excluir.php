<?php
include('Db.php'); 


if(!isset($_GET['id']) || empty($_GET['id'])){
    die("Aluno não encontrado");
}

$id = $_GET['id'];

// Prepara o DELETE
$stmt = $conn->prepare("DELETE FROM alunos WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

// Redireciona após excluir
header("Location: index.php");
exit;
?>
