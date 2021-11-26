<?php 
    require_once "Login.php";

    (new login)->deslogar();

    header("Location: index.html")
?>