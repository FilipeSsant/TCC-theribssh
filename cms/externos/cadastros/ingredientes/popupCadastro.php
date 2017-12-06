<?php

	//Pega o modo que esta sendo passado na url
	if(isset($_GET['modo'])){
		//Pega os objetos após a ? e guarda na variavel
		$modo = $_GET['modo'];
		$id = $_GET['id'];

		//Esse switch serve para usando a variavel modo tenha varios resultados
		switch($modo){
			//Case para alterar um item
			case 'alterar':
				//Guarda o id na sessão
				$_SESSION['idIngrediente'] = $id;
				//Muda o titulo do PopUp
				$tituloPopUp = "Alterar";
				//Puxa os dados referente ao id
				$sql = "select * from tbl_ingrediente where id_ingrediente = ".$id;
				$select = mysql_query($sql);
				if($rs = mysql_fetch_array($select)){
					$nomeIngrediente = $rs['nome'];
				}

				?>
					<script>
						$(document).ready(function(){
							abrirPopUp();
						});
					</script>
				<?php

				//Muda o value do botão
				$valueBotao = "Alterar";
				break;
		}
	}


?>
<!--Div de Cadastro-->
<div id="div_foraCadastro">
    <!--Botão fechar-->
    <a href="crud_ingredientes.php">
        <div class="botao_fecharPopUp" onClick="fecharPopUp()">
            <img src="img/fecharPopUp.png" alt="">
        </div>
    </a>    
    <!--Div de Login-->
    <div id="div_cadastro">
        <!--Título div Cadastro-->
        <div class="titulo_loginCadastro">
            <!--Linha atras do Titulo-->
            <div class="linha_atrasDoTitulo">
            </div>
            <!--Texto do Título-->
            <div class="div_tituloCadastro">
                <?php
                
                    if(isset($_GET['modo'])){
                        $tituloPopUp = "Alterar";
                    }
                
                ?>
                <span><?php echo($tituloPopUp); ?> Ingrediente</span>
            </div>
        </div>
        <!--Formulário de preenchimento para Login-->
        <div id="formulario_cadastro">
            <form name="formCadastroCargos" method="post" action="crud_ingredientes.php">
                <!--Nome cargo-->
                <input value="<?php echo($nomeIngrediente); ?>" class="input_texto" type="text" name="txt_nomeIngrediente" placeholder="Nome do Ingrediente" required><br>
                <!--Botão Cadastrar-->
                <button id="botao_cadastrar" value="<?php echo($valueBotao); ?>" type="submit" name="btnCadastrar_ingrediente">
                    <?php echo($valueBotao); ?>
                </button>
            </form>
        </div>
    </div>
</div>
