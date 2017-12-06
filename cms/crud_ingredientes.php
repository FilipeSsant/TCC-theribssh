<?php
	session_start();

	//Conexão com o banco
    include_once('../conexao/mysql.php');

    $sql = "select * from tbl_cargopermissao where id_cargo = ".$_SESSION['idCargoFuncionarioU']." and id_permissao = 9";
    $select = mysql_query($sql) or die(mysql_error());

    if($rs=mysql_fetch_array($select)){

    }else{
        //Faz o usuário voltar para a home caso não seja cadastrado e queira entrar pela url
        ?>
            <script>window.location = "../index.php";</script>
        <?php
    }

    //Removendo Probabilidade de Erros Por Campos Não opcionais vazios
    $nomeIngrediente = "";

	//Muda o titulo do PopUp
	$tituloPopUp = "Cadastrar";
	//Muda o value do botão
	$valueBotao = "Cadastrar";

    $id="";

    if(isset($_GET["id"])){
        $id = $_GET["id"];
        $_SESSION["idCargo"] = $id;
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Cms - Sistema de Gerenciamento</title>
        <link rel="stylesheet" href="css/cssUniversal.css">
        <link rel="stylesheet" href="css/crud_ingredientes.css">
        <link href="fontes/openSans" rel="stylesheet">
        <link href="fontes/openSans" rel="stylesheet">
        <link rel="icon" href="../icon.png" type="image/x-icon" />
        <script type="text/javascript" src="jquery/jquery-2.2.4.js" ></script>
        <script type="text/javascript" src="jquery/jquerymaskplugin.js" ></script>
        <script>
            //Inclui uma janelinha que mostra os detalhes do usuário quando é passado
            //o mouse por cima da foto
            <?php include_once('jsFunctions/mostrarJanelaDetalhes.js');?>
            //Inclui o pop up do cadastro da página
            <?php include_once('jsFunctions/popup.js');?>

        </script>
    </head>
    <body>
        <!--Fundo Transparente-->
        <div id="fundo_transparente">

        </div>
        <div id="esqueleto">
            <?php include_once('externos/cadastros/ingredientes/popupCadastro.php'); ?>
            <!--Cabeçalho-->
            <?php

                include_once('cabecalho/cabecalho.php');

                if(isset($_POST['btnCadastrar_ingrediente'])){
                    //Resgata os valores
                    $nomeIngrediente = $_POST['txt_nomeIngrediente'];

                    if($_POST['btnCadastrar_ingrediente'] == 'Cadastrar'){

                        //Insere os dados no banco
                        $sql = "insert into tbl_ingrediente (nome)";
                        $sql = $sql."values ('".$nomeIngrediente."')";

                        if(mysql_query($sql) or die(mysql_error())){
                            ?>
                                <script>
                                    swal({
                                      title: "Sucesso!",
                                      text: "Cadastro realizado com Sucesso!",
                                      type: "success",
                                      icon: "success",
                                      button: {
                                                 text: "Ok",
                                             },
                                      closeOnEsc: true,
                                  });
                                  //Voltar para o php sem dados na url
                                  setTimeout(function(){
                                      window.location = "crud_ingredientes.php";
                                  }, 1800);
                                </script>
                            <?php
                        }else{
                            ?>
                                <script>
                                    swal({
                                      title: "Erro!",
                                      text: "Houve um erro no nosso Banco de Dados.",
                                      type: "error",
                                      icon: "error",
                                      button: {
                                                 text: "Ok",
                                               },
                                      closeOnEsc: true,
                                    });
                                    //Voltar para o php sem dados na url
                                    setTimeout(function(){
                                        window.location = "crud_ingredientes.php";
                                    }, 1800);
                                </script>
                            <?php
                        }

                    }elseif($_POST['btnCadastrar_ingrediente'] == 'Alterar'){

                        //Altera os dados do banco
                        $sql = "update tbl_ingrediente set nome = '".$nomeIngrediente."' where id_ingrediente = ". $_SESSION['idIngrediente'];

                        if(mysql_query($sql) or die(mysql_error())){
                            unset($_SESSION['idIngrediente']);
                            ?>
                                <script>
                                    swal({
                                      title: "Sucesso!",
                                      text: "Dados Alterados com sucesso!",
                                      type: "success",
                                      icon: "success",
                                      button: {
                                                 text: "Ok",
                                             },
                                      closeOnEsc: true,
                                  });
                                  //Voltar para o php sem dados na url
                                  setTimeout(function(){
                                      window.location = "crud_ingredientes.php";
                                  }, 1800);
                                </script>
                            <?php
                        }else{
                            ?>
                                <script>
                                    swal({
                                      title: "Erro!",
                                      text: "Houve um erro no nosso Banco de Dados.",
                                      type: "error",
                                      icon: "error",
                                      button: {
                                                 text: "Ok",
                                               },
                                      closeOnEsc: true,
                                    });
                                    //Voltar para o php sem dados na url
                                    setTimeout(function(){
                                        window.location = "crud_ingredientes.php";
                                    }, 1800);
                                </script>
                            <?php
                        }
                    }
                }
				
				//Pega o modo que esta sendo passado na url
				if(isset($_GET['modo'])){
					//Pega os objetos após a ? e guarda na variavel
					$modo = $_GET['modo'];
					$id = $_GET['id'];

					//Esse switch serve para usando a variavel modo tenha varios resultados
					switch($modo){
						
						//Case para deletar um item
						case 'deletar':
							$idIngredienteBanco = "";
							
							$sql = "select * from tbl_ingredienteproduto";
							
							$select = mysql_query($sql) or die(mysql_error);
							
							if($rs=mysql_fetch_array($select)){
								$idIngredienteBanco = $rs['id_ingrediente'];
							}
							
							if($idIngredienteBanco != $id){
								//Deleta o item usando seu id
								$sql = "delete from tbl_ingrediente where id_ingrediente = ".$id;
								mysql_query($sql);
								//Voltar para o php sem dados na url
								?>
									<script>
									//Voltar para o php sem dados na url
									setTimeout(function(){
									  window.location = "crud_ingredientes.php";
									}, 3000);
									</script>
								<?php
								break;
							}else{
								?>
									<script>
										swal({
										  title: "Erro!",
										  text: "O ingrediente está relecionado com um produto!",
										  type: "error",
										  icon: "error",
										  button: {
													 text: "Ok",
												 },
										  closeOnEsc: true,
									  });
									  //Voltar para o php sem dados na url
									  setTimeout(function(){
										  window.location = "crud_ingredientes.php";
									  }, 3000);
									</script>
								<?php
								break;
							}		
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
            <!--Conteúdo-->
            <section>
                <!--Menu-->
                <!--Inclui o menu que irá aparecer em todas as páginas-->
                <?php include_once('externos/menu_universal.php'); ?>
                <!--Título do Crud-->
                <div id="div_titulo_crud">
                    <div id="titulo_crud">
                        Crud de Ingredientes
                    </div>
                    <!--Icone do Crud-->
                    <div id="div_icone_crud">
                        <img src="img/crud_ingredientes.png" alt="">
                    </div>
                </div>
                <div id="div_foraTabela">
                    <!--Crud-->
                    <div id="div_conteudo">
                        <!--Tabela Cargos-->
                        <div id="tabela_crud_titulos">
                            <div class="titulo_colunaPoucosCampos">
                                Nome
                            </div>
                            <div class="titulo_2opcColuna">
                                Opções
                            </div>
                        </div>
                        <?php
                            //Seleciona os cargos existentes no banco
                            $sql = "select * from tbl_ingrediente order by nome";

                            $select = mysql_query($sql) or die(mysql_error());

                            while($rs = mysql_fetch_array($select)){
                                $id = $rs['id_ingrediente'];
                                $nomeIngrediente = $rs['nome'];
                        ?>
                        <div class="tabela_crud_conteudo">
                            <div class="conteudo_colunaPoucosCampos">
                                <?php echo($nomeIngrediente); ?>
                            </div>
                            <div class="coluna_2opcoes">
                                <!--Alterar-->
                                <a href="crud_ingredientes.php?id=<?php echo($id); ?>&modo=alterar">
                                    <div class="opcao_registro">
                                        <div class="imagem_opcao">
                                            <img src="img/alterar.png" alt="" title="Alterar">
                                        </div>
                                    </div>
                                </a>
                                <!--Apagar-->
                                <a href="crud_ingredientes.php?id=<?php echo($id); ?>&modo=deletar">
                                    <div class="opcao_registro">
                                        <div class="imagem_opcao">
                                            <img src="img/apagar.png" alt="" title="Apagar">
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
                <!--Botão Cadastrar-->
                <button id="botao_cadastrar2" onclick="abrirPopUp()">
                    <img src="img/adicionarIcon.png" alt="" title="Cadastrar Cargo">
                </button>
            </section>
            <!--Rodapé-->
            <?php include_once('rodape/rodape.php'); ?>
        </div>
    </body>
</html>
