<?php

    $resultado = "";

    //Verifica as condições do Login se ele existe no banco
    if(isset($_POST['caixalogin'])){
        //Conexão com o banco
        include_once('../conexao/mysql.php');

        //Pega no post as informações da caixa
        $textoLogin = $_POST['caixalogin'];

        //Comando SQL
        $sql = "select login from tbl_cliente";
        $select = mysql_query($sql);

        //Verifica se o usuário existe no banco
        while($rs=mysql_fetch_array($select)){

            
            $sql2 = "select login from tbl_funcionario";
            $select2 = mysql_query($sql2);

            while($rs2=mysql_fetch_array($select2)){
                $loginFuncionarioBanco = $rs2['login'];
                $loginDoBanco = $rs['login'];

                if($textoLogin == $loginDoBanco || $textoLogin == $loginFuncionarioBanco){
                    $resultado = "<img src='../img/errado.png' alt='' title='Login já existente'>";

                }
                
            }

            


        }

    }

    echo($resultado);
?>
