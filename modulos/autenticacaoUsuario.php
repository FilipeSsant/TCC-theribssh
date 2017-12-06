<?php

    $login = "";
    $senha = "";

    if(isset($_POST['botaoLogin'])){
      //Se as caixas de texto estiverem preenchidas		
      if($_POST['txt_login'] != null && $_POST['txt_senha'] != null){
        $login = $_POST['txt_login'];
        $senha = $_POST['txt_senha'];

        $sql = "select * from tbl_cliente where login = '".$login."' and senha = '".$senha."'";

        $select = mysql_query($sql);

        if($rs = mysql_fetch_array($select)){
              $_SESSION['id_cliente'] = $rs['id_cliente'];
        }else{

	    $sql = "select * from tbl_cliente where email = '".$login."' and senha = '".$senha."'";	

	    $select = mysql_query($sql);

	    if($rs = mysql_fetch_array($select)){
		$_SESSION['id_cliente'] = $rs['id_cliente'];
	    }else{				

            ?>
            <script>

            swal({
                  title: "Erro!",
                  text: "O usuário ou senha estão incorretos.",
                  type: "error",
                  icon: "error",
                  button: {
                             text: "Ok",
                           },
                  closeOnEsc: true,
            });
            </script>
            <?php
	    }	
        }

      }else{
        ?>
            <script>

            swal({
                  title: "Erro!",
                  text: "O usuário ou a senha não foram preenchidos.",
                  type: "error",
                  icon: "error",
                  button: {
                             text: "Ok",
                           },
                  closeOnEsc: true,
            });
            </script>
            <?php  
      }

    }

?>