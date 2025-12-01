<?php
session_start();

// Se a variável de sessão 'loggedin' não existir ou não for verdadeira,
// redireciona o usuário para a página de login.
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Quiz de Viagem | Destino Certeiro</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="./styleperfil.css">
  <link rel="stylesheet" href="./stylequiz.css">
  <script src="./quiz.js" defer></script>
  
  <script>
        // Passa o resultado do quiz da sessão PHP para o JavaScript
        const resultadoSalvo = '<?php echo isset($_SESSION["quiz"]) ? htmlspecialchars($_SESSION["quiz"]) : ""; ?>';
    </script>
    <script src="./quiz.js" defer></script>
</head>

<body>
  <form action="processa_quiz_js.php" method="POST" id="form-resultado" style="display: none;">
    <input type="hidden" name="perfil_resultado" id="perfil_resultado">
</form>
  <!-- ====== MENU ====== -->
  <nav class="navbar navbar-expand-lg navbar-dark">
    <a class="navbar-brand" href="index.html">Destino Certeiro</a>
    <img src="./imagens/logo-sem-fundo.png" alt="logo" class="logo">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active"><a class="nav-link" href="index.html">Início</a></li>
        <li class="nav-item"><a class="nav-link" href="quiz.php">Quiz</a></li>
        <li class="nav-item"><a class="nav-link" href="login.php">Conta</a></li>
        <li class="nav-item"><a class="nav-link" href="cadastrar_login.php">Cadastro</a></li>
        <li class="nav-item"><a class="nav-link" href="contato.html">Contato</a></li>
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Pesquisar" aria-label="Pesquisar">
        <button class="btn btn-warning my-2 my-sm-0 text-dark" type="submit">Pesquisar</button>
      </form>
    </div>
  </nav>

 <br><br><br>
  <div class="container">
    <main>
      <!-- QUIZ EM ANDAMENTO -->
      <div id="quizz-container">
        <h1>Quiz de Viagem</h1>
        <p id="question">
          <span id="question-number">1</span> —
          <span id="question-text">Carregando pergunta...</span>
        </p>
        <div id="answers-box"></div>

        <!-- TEMPLATE INVISÍVEL PARA AS RESPOSTAS -->
        <button class="answer-template hide">
            <span class="btn-letter">A</span>
            <span class="question-answer">Resposta exemplo</span>
        </button>
      </div>

      <!-- RESULTADO FINAL -->
      <div id="resultado-geral" class="hide">

        <!-- CARD NACIONAL -->
        <div class="card-lateral card-esquerdo">
          <div class="card-imagem">
            <img id="imagem-esquerda" src="imagens/brasil.jfif" alt="Destino Nacional" />
          </div>
          <div class="card-tipo">Sugestão Nacional</div>
            <h3 id="card-esquerdo-titulo"></h3>
            <p id="card-esquerdo-sugestao" style="font-weight:700; color:#002ab3;"></p> <!-- NOVO -->
            <p id="card-esquerdo-descricao"></p>
            <a id="card-esquerdo-link" href="#" target="_blank">
              <div class="btn-pacote"></div>
            </a>
        </div>

        <!-- BLOCO CENTRAL -->
        <div id="score-container">
          <h2>Resultado do seu perfil de viagem</h2>
          <p id="display-score"><span>Carregando...</span></p>

          <div class="botoes">
            <button id="restart">Refazer quiz</button>
            <a href="index.html"><button id="voltar">Voltar à página inicial</button></a>
          </div>
        </div>

        <!-- CARD INTERNACIONAL -->
        <div class="card-lateral card-direito">
          <div class="card-imagem">
            <img id="imagem-direita" src="imagens/aviao.webp" alt="Destino Internacional" />
          </div>
          <div class="card-tipo">Sugestão Internacional</div>
            <h3 id="card-direito-titulo"></h3>
            <p id="card-direito-sugestao" style="font-weight:700; color:#002ab3;"></p> <!-- NOVO -->
            <p id="card-direito-descricao"></p>
            <a id="card-direito-link" href="#" target="_blank">
              <div class="btn-pacote"></div>
            </a>
          </div>
        </div>
    </main>
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
