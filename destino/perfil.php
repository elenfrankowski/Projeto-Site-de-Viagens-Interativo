<?php
session_start();

// Se a variável de sessão 'loggedin' não existir ou não for verdadeira,
// redireciona o usuário para a página de login com um aviso de acesso restrito.
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php?restrito=1");
    exit;
}
?>

<!DOCTYPE html>
<html lang="PT-BR">
<head>
  <title>Site Destino Certeiro - Perfil</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Fredericka+the+Great&family=Open+Sans:wght@300;400;600&family=Pacifico&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./style.css"> 
  <link rel="stylesheet" href="./styleperfil.css"> </head>

<body>
 <body class="menu">
    <nav class="navbar navbar-expand-lg navbar-dark">
    <a class="navbar-brand" href="index.html">Destino Certeiro</a>
    <img src="./imagens/logo-sem-fundo.png" alt="logo" class="logo"> <!--Logo-->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
      <ul class="navbar-nav mr-auto">
       <li class="nav-item active">
          <a class="nav-link" href="index.html">Início <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="quiz.php">Quiz</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="login.php">Conta</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cadastrar_login.php">Cadastro</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contato.html">Contato</a>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Pesquisar" aria-label="Pesquisar">
        <button class="btn btn-warning my-2 my-sm-0 text-dark" type="submit">Pesquisar</button>
      </form>
    </div>
  </nav>

  </nav>
 <br><br><br>
  <div class="m">
    <div class="container containerperfil">
        <h2 id="titulo" class="text-center mb-4">Carregando perfil...</h2>
        <div class="perfil-info">
          <p><strong>Usuário:</strong> abc</p>
          <p><strong>Email:</strong> abc@gmail.com</p>
          <p><strong>Resultado do quiz:</strong> Histórico</p>
        </div>
        <a href="logout.php">Sair</a>
    </div>
    
    <script>
      // Função para buscar os dados do utilizador
      fetch("perfil_dados.php")
        .then(res => res.json()) // Converte a resposta para JSON
        .then(data => {
          if (data.erro) {
            // Se houver um erro (ex: não logado), redireciona para o login
            window.location.href = "login.php"; 
          } else {
            // Preenche os elementos HTML com os dados
            document.getElementById("titulo").textContent = "Bem-vindo, " + data.nome + "!";
            document.getElementById("nome").textContent = data.nome;
            document.getElementById("email").textContent = data.email;
            // Se 'quiz' for nulo, exibe uma mensagem
            document.getElementById("quiz").textContent = data.quiz || "Ainda não fez o quiz.";
          }
        })
        .catch(error => {
            console.error('Erro ao carregar dados do perfil:', error);
            document.getElementById("titulo").textContent = "Erro ao carregar dados.";
        });
    </script>
  </div>
  
 
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
 <br><br><br><br>
</body> 
  <section class="rodape">
    <footer class="container">
      <p><a href="#">Voltar ao topo</a></p>
      <p>&copy; 2025 Certeiro, Destino &middot; <a href="#">Privacidade</a> &middot; <a href="#">Termos</a></p> 
    </footer>
  </section>

</html>