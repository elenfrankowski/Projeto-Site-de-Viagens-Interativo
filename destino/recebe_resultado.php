<?php
include 'conexao.php';

// Verifica se recebeu os dados
if (isset($_POST['id_usuario']) && isset($_POST['resultado'])) {
    $id_usuario = $_POST['id_usuario'];
    $resultado = $_POST['resultado'];

    $sql = "UPDATE usuarios SET resultado_quiz = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $resultado, $id_usuario);
    $stmt->execute();

    echo "OK"; // resposta simples para o Java
} else {
    echo "Erro: dados incompletos.";
}
?>
 