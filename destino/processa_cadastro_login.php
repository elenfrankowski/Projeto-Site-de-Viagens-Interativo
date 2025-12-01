<?php
// =======================================================
// 1. CONFIGURAÇÕES DO BANCO DE DADOS
// =======================================================
$host = 'localhost';
$port = '5432';
$dbname = 'postgres'; 
$user = 'postgres';
$password = 'postgres';

// =======================================================
// 2. PROCESSAMENTO DO FORMULÁRIO
// =======================================================
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    // Acesso indevido
    header("Location: cadastrar_login.php"); // <<< CORRIGIDO (para o ficheiro que você enviou)
    exit();
}

// Captura os dados do formulário
$nome = $_POST['nome'] ?? '';
$email = $_POST['email'] ?? '';
$senha_digitada = $_POST['senha'] ?? '';

// Validação básica
if (empty($nome) || empty($email) || empty($senha_digitada)) {
    header("Location: cadastrar_login.php?erro=" . urlencode("Todos os campos são obrigatórios.")); // <<< CORRIGIDO
    exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: cadastrar_login.php?erro=" . urlencode("O formato do email é inválido.")); // <<< CORRIGIDO
    exit();
}

// Criptografa a senha
$senha_hash = password_hash($senha_digitada, PASSWORD_DEFAULT);

// =======================================================
// 3. CONEXÃO E INSERÇÃO
// =======================================================
try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // <<< CORREÇÃO: Mudar de 'usuarios_login' para 'usuarios'
    $sql_check = "SELECT id FROM login_viagem WHERE email = :email";
    $stmt_check = $pdo->prepare($sql_check);
    $stmt_check->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt_check->execute();

    if ($stmt_check->fetch()) {
        header("Location: cadastrar_login.php?erro=" . urlencode("Este email já está cadastrado.")); // <<< CORRIGIDO
        exit();
    }

    // <<< CORREÇÃO: Mudar de 'usuarios_login' para 'usuarios'
    $sql = "INSERT INTO login_viagem (nome, email, senha) VALUES (:nome, :email, :senha)";
    $stmt = $pdo->prepare($sql);

    // Associa os parâmetros
    $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':senha', $senha_hash, PDO::PARAM_STR);

    // Executa a query
    $stmt->execute();

    // Redireciona de volta para a página de cadastro com mensagem de sucesso
    header("Location: cadastrar_login.php?sucesso=1"); // <<< CORRIGIDO
    exit();

} catch (PDOException $e) {
    header("Location: cadastrar_login.php?erro=" . urlencode("Erro no banco de dados: " . $e->getMessage())); // <<< CORRIGIDO
    exit();
}
?>