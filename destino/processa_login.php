<?php
session_start();

// =======================================================
// 1. CONEXÃO COM O BANCO DE DADOS
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
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}

// =======================================================
// 2. VERIFICA ENVIO DO FORMULÁRIO
// =======================================================
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST['email'] ?? '');
    $senha = trim($_POST['senha'] ?? '');

    if (empty($email) || empty($senha)) {
        header("Location: login.php?erro=campos_vazios");
        exit;
    }

    try {
        // =======================================================
        // 3. CONSULTA USUÁRIO NO BANCO
        // =======================================================
        // (A sua tabela chama-se 'login_viagem' de acordo com o ficheiro)
        $sql = "SELECT * FROM login_viagem WHERE email = :email LIMIT 1"; 
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $usuarioEncontrado = $stmt->fetch(PDO::FETCH_ASSOC);

        // =======================================================
        // 4. VERIFICA USUÁRIO E SENHA
        // =======================================================
        if ($usuarioEncontrado) {
            if (password_verify($senha, $usuarioEncontrado['senha'])) {
                
                // <<< INÍCIO DA CORREÇÃO >>>
                // Armazena os dados na sessão com os nomes corretos
                // que o 'perfil_dados.php' espera.
                $_SESSION['loggedin'] = true;
                $_SESSION['id'] = $usuarioEncontrado['id']; 
                $_SESSION['nome'] = $usuarioEncontrado['nome'];
                $_SESSION['email'] = $usuarioEncontrado['email']; 
                $_SESSION['quiz'] = $usuarioEncontrado['quiz'] ?? null; // (Adiciona o quiz se existir)
                // <<< FIM DA CORREÇÃO >>>

                header("Location: perfil.php");
                exit;
            } else {
                // Erro de senha (CORRIGIDO para .php)
                header("Location: login.php?erro=senha_incorreta"); 
                exit;
            }
        } else {
            // Erro de email (CORRIGIDO para .php)
            header("Location: login.php?erro=email_inexistente"); 
            exit;
        }

    } catch (PDOException $e) {
        die("Erro ao verificar login: " . $e->getMessage());
    }
} else {
    header("Location: login.php");
    exit;
}
?>