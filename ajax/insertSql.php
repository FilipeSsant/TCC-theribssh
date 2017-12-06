<?php

    //Conexão com o banco
    include_once('../conexao/mysql.php');

    if(isset($_POST['sql'])){
        $sql = $_POST['sql'];
        mysql_query($sql) or die(mysql_error());
    }

?>
