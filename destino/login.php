<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Login</title>
    <link rel="stylesheet" href="./styleform.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" 
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Fredericka+the+Great&family=Open+Sans:wght@300;400;600&family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="./styleperfil.css">
    <link rel="stylesheet" href="./style/mobile.css">
    <script src="./script/index.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <style>
        .erro-login {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body class="menu">

  <!-- Menu -->
  <nav class="navbar navbar-expand-lg navbar-dark">
    <a class="navbar-brand" href="index.html">Destino Certeiro</a>
    <img src="./imagens/logo-sem-fundo.png" alt="logo" class="logo">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado">
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
        <input class="form-control mr-sm-2" type="search" placeholder="Pesquisar">
        <button class="btn btn-warning my-2 my-sm-0 text-dark" type="submit">Pesquisar</button>
      </form>
    </div>
  </nav>

  <!--Título e Logo-->
  <div class="titulo-site text-center mt-4">
    <h1>Destino Certeiro</h1>
    <img src="./imagens/logo-sem-fundo.png" alt="Logo Destino Certeiro" class="logo-site">
  </div>  

  <!-- Formulário de Login -->
  <div class="container formulario">
    <form action="processa_login.php" method="post">
        <h1>Acessar Sistema</h1>

        <?php if (isset($_GET['erro'])): ?>
            <p class="erro-login">Email ou senha inválidos. Tente novamente.</p>
        <?php endif; ?>
        
        <?php if (isset($_GET['restrito'])): ?>
            <p class="erro-login">Esta página é restrita. Faça login para continuar.</p>
        <?php endif; ?>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Digite seu email" required>
        </div>

        <div class="form-group">
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required>
        </div>

        <button type="submit">Entrar</button>
        <a href="cadastrar_login.php" style="display: block; text-align: center; margin-top: 20px;">
          Não tem uma conta? Cadastre-se
        </a>
    </form>
  </div>

  <!--Rodapé-->
  <section class="rodape">
    <footer class="container">
      <p><a href="#">Voltar ao topo</a></p>
      <p>&copy; 2025 Certeiro, Destino &middot; 
        <a href="#">Privacidade</a> &middot; <a href="#">Termos</a>
      </p> 
    </footer>
  </section>

  <!-- Bootstrap JS e dependências -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</body>
</html>
