<?php

    $resultado = "";

    //Verifica as condições do Login se ele existe no banco
    if(isset($_POST['caixaemail'])){
        //Conexão com o banco
        include_once('../conexao/mysql.php');

        //Pega no post as informações da caixa
        $textoEmail = $_POST['caixaemail'];

        //Comando SQL
        $sql = "select email from tbl_cliente";
        $select = mysql_query($sql);

        //Verifica se o usuário existe no banco
        while($rs=mysql_fetch_array($select)){

            $sql2 = "select email from tbl_funcionario";
            $select2 = mysql_query($sql2);

            while($rs2=mysql_fetch_array($select2)){
                $emailFuncionario = $rs2['email'];
                $emailDoBanco = $rs['email'];

                if($textoEmail == $emailDoBanco || $textoEmail == $emailFuncionario){
                    $resultado = "<img src='../img/errado.png' alt='' title='Login já existente'>";
                }
            }

        }

    }

    echo($resultado);
?>
