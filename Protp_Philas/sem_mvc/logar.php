<?php
require_once(__DIR__ . "\\Login.php");
$Login = new Login();

if ($Login->estaLogado()) header("Location: home");

if (isset($_POST["logar"])) {
  require_once(__DIR__ . "\\usuario\\Usuario.php");
  $Usuario = new Usuario;

  $Usuario->login = $_POST["usuario"];
  $Usuario->senha = $_POST["senha"];

  if ($Login->logar($Usuario, !empty($_POST["chk_lembrar"]))) {
    header("Location: home");
  } else {
    // echo "Falha no login";
    echo '<script> window.alert(`Usuário ou senha incorretos`) </script>';
  }
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors" />
    <meta name="generator" content="Hugo 0.84.0" />
    <title>Prototipo Philas</title>

    <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

    <!-- CSS -->
    <!-- <link href="css/style.css" rel="stylesheet" type="text/css" /> -->
    <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../css/signin.css" rel="stylesheet" />

    <!-- javascript -->
    <script src="../../jquery/js/jquery-3.5.1.min.js" type="text/javascript"></script>
    <script src="../../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../js/script.js" type="text/javascript"></script>

    <!-- Style para validação -->
    <link href="../css/form-validation.css" rel="stylesheet" />
  </head>

  <style>
    .invalido {
      border-color: #dc3545 !important;
      padding-right: calc(1.5em + 0.75rem) !important;
      background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e") !important;
      background-repeat: no-repeat !important;
      background-position: right calc(0.375em + 0.1875rem) center !important;
      background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem) !important;
    }

    .invalido:focus {
      border-color: #dc3545 !important;
      box-shadow: 0 0 0 0.25rem rgb(220 53 69 / 25%) !important;
    }

    .invalido + .invalid-feedback {
      display: block;
    }
  </style>

  <body>
    <div class="form-signin">
      <form id="frmLogin" action="" method="POST" class="needs-validation" novalidate>
        <div class="text-center">
          <img src="../img/Prop_Philas-Logo.svg" alt="" width="150" height="150" />
        </div>

        <div class="form-floating">
          <input type="text" name="usuario" class="form-control" id="usuario" placeholder="Login ou Email" required />
          <label for="usuario" class="form-label">Login ou Email</label>
          <div class="invalid-feedback justify-content">Login ou Email é obrigatório.</div>
        </div>

        <div class="form-floating">
          <input type="password" name="senha" class="form-control" id="senha" placeholder="Senha" required />
          <label for="senha">Senha</label>
          <div class="invalid-feedback">Senha é obrigatória.</div>
        </div>

        <div class="checkbox mb-3 text-">
          <div class="text-center">
            <label> <input type="checkbox" value="remember-me" name="chk_lembrar" /> Lembrar de mim </label>
          </div>
        </div>

        <button class="w-100 btn btn-lg btn-dark" type="submit" name="logar">Entrar</button>

        <br />
        <br />
      </form>
      <!-- FIXME: ? ou deixa com form mesmo? (se bem qeu acho que vai conflitar la na frente) -->
      <!-- <form action="cadastrar.php" method="POST">
        <button class="w-100 btn btn-lg btn-link" type="submit" name="cadastrar">Criar conta</button>
      </form> -->

      <a  class="w-100 btn btn-lg btn-link">Criar conta</a>

      <script src="../../bootstrap/js/bootstrap.bundle.min.js" type="text/javascript"></script>

      <script src="../js/form-validation.js" type="text/javascript"></script>

      <footer class="my-3 pt-3 text-muted text-center text-small">
        <ul class="list-inline">
          <li class="list-inline-item"><a href="#">Privacidade</a></li>
          <li class="list-inline-item"><a href="#">Termos</a></li>
          <li class="list-inline-item"><a href="#">Suporte</a></li>
        </ul>
      </footer>
    </div>
  </body>
</html>
