<?php

    //Quando o usuário clicar em Login no Pop Up de Login vai verificar se o funcionário existe no banco
    if(isset($_POST['botaoLoginFuncionario'])){
          //Se as caixas de texto estiverem preenchidas		
          if($_POST['txt_loginF'] != null && $_POST['txt_senhaF'] != null){
            $login = $_POST['txt_loginF'];
            $senha = $_POST['txt_senhaF'];

            $sql = "select * from tbl_funcionario where login = '".$login."' and senha = '".$senha."'";

            $select = mysql_query($sql);

            if($rs = mysql_fetch_array($select)){
                  $_SESSION['id_funcionario'] = $rs['id_funcionario'];
                  ?>
                     <script>window.location = "../cms/home.php";</script>
                  <?php
            }else{
				
				$sql = "select * from tbl_funcionario where email = '".$login."' and senha = '".$senha."'";

				$select = mysql_query($sql);
				
				if($rs = mysql_fetch_array($select)){
					$_SESSION['id_funcionario'] = $rs['id_funcionario'];
					?>
						<script>window.location = "../cms/home.php";</script>
					<?php
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