<?php
require_once(__DIR__ . "\\Login.php");
$Login = new Login();

if (!$Login->estaLogado()) header("Location: index.html");

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Prototipo Philas</title>

    <!-- <base href="http://localhost/TCC/Protp_Philas/" /> -->

    <!-- CSS -->
    <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- <link href="css/style.css" rel="stylesheet" type="text/css" /> -->

    <!-- javascript -->
    <script src="../../jquery/js/jquery-3.5.1.min.js" type="text/javascript"></script>
    <script src="../../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../js/script.js" type="text/javascript"></script>

    <!-- Custom styles for this template -->
    <link href="../css/sidebars.css" rel="stylesheet">
</head>

<body>

    <!-- Imagens -->
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="people-circle" viewBox="0 0 16 16">
            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
            <path fill-rule="evenodd"
                d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
        </symbol>
    </svg>
    <!-- fim imagens -->

    <header>

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <img src="../img/Prop_Philas-Logo.svg" alt="" width="100" height="100" />
                <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarsExample02" aria-controls="navbarsExample02" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <svg class="bi text-white" width="40" height="40">
                        <use xlink:href="#people-circle" />
                    </svg>

                </button>  -->

                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link text-white dropdown-toggle" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <svg class="bi me-2" width="40" height="40">
                                <use xlink:href="#people-circle" />
                            </svg>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdown03" data-bs-popper="none">
                            <li> <a class="dropdown-item" href="minhaConta"> Minha conta </a> </li>
                            <li> <a class="dropdown-item" href="logout"> Sair </a> </li>
                        </ul>
                    </li>

                </ul>



            </div>
        </nav>

    </header>


    <br/>
    <div class="container d-grid gap-3">
    <a class="w-100 btn btn-lg btn-dark" href="agendar" role="button"> Agendar Horário </a>
    <a class="w-100 btn btn-lg btn-dark" href="historico" role="button"> Histórico </a>
    <!-- <a class="w-100 btn btn-lg btn-dark" href=".php" role="button"> pinto </a>
    <a class="w-100 btn btn-lg btn-dark" href=".php" role="button"> sumiu </a> -->
    </div>



</body>

</html>