<?php

    //Inicia sessão
    session_start();
    //Reseta as variaveis de sesssão
    $_SESSION = array();
    //Destrói a sessão
    session_destroy();
    //Manda pra a home
    header("location:../home/home.php");


?>
