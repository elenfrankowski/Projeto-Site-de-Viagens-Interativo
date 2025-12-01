<?php
session_start();

// Protege a página
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Redireciona para login em caso de acesso não autorizado
    header("Location: login.php");
    exit;
}

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: login.php");
    exit;
}

// =======================================================
// 1. CONEXÃO COM O BANCO DE DADOS (PostgreSQL)
// =======================================================
$host = 'localhost';
$port = '5432';
$dbname = 'postgres';
$user = 'postgres';
$password = 'postgres';

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Em caso de erro de conexão
    error_log("Erro na conexão com o banco de dados: " . $e->getMessage());
    header("Location: quiz.php?erro_db=1");
    exit;
}

// =======================================================
// 2. ATUALIZAR O BANCO DE DADOS E A SESSÃO
// =======================================================

try {
    // Pega o resultado (Ex: "Natureza") enviado pelo formulário escondido
    $resultado_quiz = $_POST['perfil_resultado'] ?? 'Indefinido';
    
    // Pega o ID do utilizador que está logado
    $id_usuario = $_SESSION['id']; 

    // Prepara o SQL para ATUALIZAR (UPDATE) o perfil
    // (Usa a tabela 'login_viagem' do seu sistema)
    $sql = "UPDATE login_viagem SET quiz = :resultado WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    
    $stmt->bindParam(':resultado', $resultado_quiz);
    $stmt->bindParam(':id', $id_usuario, PDO::PARAM_INT);
    $stmt->execute();

    // 3. Atualizar a SESSÃO com o resultado (IMPORTANTE para o quiz.js)
    $_SESSION['quiz'] = $resultado_quiz; 
    
    // =======================================================
    // CORREÇÃO APLICADA: REDIRECIONAR APÓS O PROCESSAMENTO
    // =======================================================
    // Redireciona o navegador para a página do quiz.
    header("Location: quiz.php");
    exit(); // Encerra o script após o redirecionamento
    
} catch (PDOException $e) {
    // Em caso de erro na atualização
    error_log("Erro ao salvar resultado do quiz: " . $e->getMessage());
    header("Location: quiz.php?erro_update=1");
    exit;
}
?>