<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['id'])) {
    echo json_encode(["erro" => "Não logado"]);
    exit;
}

echo json_encode([
    "id" => $_SESSION['id'],
    "nome" => $_SESSION['nome'],
    "email" => $_SESSION['email'],
    "quiz" => $_SESSION['quiz']
]);
