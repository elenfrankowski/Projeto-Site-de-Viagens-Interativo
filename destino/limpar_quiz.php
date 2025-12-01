<?php
session_start();

// Limpa o resultado do quiz da variável de sessão
if (isset($_SESSION['quiz'])) {
    unset($_SESSION['quiz']);
}

// Redireciona o usuário de volta para a página do quiz, que agora iniciará do zero
header("Location: quiz.php");
exit;
?>