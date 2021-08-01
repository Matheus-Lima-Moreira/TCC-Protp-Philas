<!-- TODO tornar url amigavei apartir do php? ou .htaccess? -->
<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    
    <title>Prototipo Philas</title>

    <base href="http://localhost/TCC/Protp_Philas/" />

    <!-- CSS -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />

    <!-- javascript -->
    <script src="../jquery/js/jquery-3.5.1.min.js" type="text/javascript"></script>
    <script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="js/script.js" type="text/javascript"></script>
  </head>
  <?php
    // header("location: createUser");
  ?>
  <body>
      <header>
        <span>HOME</span> <span>              </span> <span>SOBRE</span> <span>              </span> <span> CONTATO</span>
      </header>

      <main>
        <span>Pinto Enorme Gigantesco</span>
        
        <div>
          <a href="createUser">Cadastrar</a> / <a href="createUser.php">Logar</a>
        </div>
      </main>

      <footer>
        <span>Eh Nois</span>
      </footer>
  </body>
</html>
