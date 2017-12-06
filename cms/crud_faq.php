<?php

    session_start();

	//Conexão com o banco
    include_once('../conexao/mysql.php');

    $sql = "select * from tbl_cargopermissao where id_cargo = ".$_SESSION['idCargoFuncionarioU']." and id_permissao = 16";
    $select = mysql_query($sql) or die(mysql_error());

    if($rs=mysql_fetch_array($select)){

    }else{
        //Faz o usuário voltar para a home caso não seja cadastrado e queira entrar pela url
        ?>
            <script>window.location = "../index.php";</script>
        <?php
    }

    //Removendo Probabilidade de Erros Por Campos Não opcionais vazios
    $pergunta = "";
    $resposta = "";

    //Muda o titulo do PopUp
  	$tituloPopUp = "Cadastrar";
  	//Muda o value do botão
  	$valueBotao = "Cadastrar";


?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>CMS - Sistema de Gerenciamento</title>
        <link rel="stylesheet" href="css/cssUniversal.css">
        <link rel="stylesheet" href="css/crud_faq.css">
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

            <?php
				//Pega o modo que esta sendo passado na url
				if(isset($_GET['modo'])){
					//Pega os objetos após a ? e guarda na variavel
					$modo = $_GET['modo'];
					$id = $_GET['id'];

					//Esse switch serve para usando a variavel modo tenha varios resultados
					switch($modo){
						//Case para deletar um item
						case 'deletar':
							//Deleta o item usando seu id
							$sql = "delete from tbl_faq where id_faq = ".$id;
							mysql_query($sql);
							//Voltar para o php sem dados na url
							header('location:crud_faq.php');
							break;

						case 'alterar':
							//Guarda o id na sessão
							$_SESSION['idFaq'] = $id;
							//Muda o titulo do PopUp
							$tituloPopUp = "Alterar";
							//Puxa os dados referente ao id
							$sql = "select * from tbl_faq where id_faq = ".$id;
							$select = mysql_query($sql);
							if($rs = mysql_fetch_array($select)){
								$pergunta = $rs['pergunta'];
                                $resposta = $rs['resposta'];
							}

							?>
								$(document).ready(function(){
									abrirPopUp();
								});
							<?php

							//Muda o value do botão
							$valueBotao = "Alterar";
							break;
					}
				}
			?>

        </script>
    </head>
    <body>
        <!--Fundo Transparente-->
        <div id="fundo_transparente">

        </div>
        <div id="esqueleto">
            <?php include_once('externos/cadastros/faq/popupCadastro.php'); ?>
            <!--Cabeçalho-->
            <?php include_once('cabecalho/cabecalho.php');?>

            <?php
            if(isset($_POST['btnCadastrar_faq'])){
                //Resgata os valores
                $pergunta = $_POST['txt_pergunta'];
                $resposta = $_POST['txt_resposta'];

                if($_POST['btnCadastrar_faq'] == 'Cadastrar'){
                      //Inserir os dados dos campos na tabela
                      $sql = "insert into tbl_faq (pergunta, resposta)";
                      $sql = $sql." values ('".$pergunta."', '".$resposta."')";

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
                                      window.location = "crud_faq.php";
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
                                        window.location = "crud_faq.php";
                                    }, 1800);
                                </script>
                            <?php
                        }
                }elseif($_POST['btnCadastrar_faq'] == 'Alterar'){
                    //Alterar os dados dos campos da tabela
                    $sql = "update tbl_faq set pergunta = '".$pergunta."', resposta = '".$resposta."' where id_faq = ".$_SESSION['idFaq'];
                    if(mysql_query($sql) or die(mysql_error())){
                            unset($_SESSION['idFaq']);
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
                                      window.location = "crud_faq.php";
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
                                        window.location = "crud_faq.php";
                                    }, 1800);
                                </script>
                            <?php
                        }
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
                        Crud do FAQ
                    </div>
                    <!--Icone do Crud-->
                    <div id="div_icone_crud">
                        <img src="img/faqIcon.png" alt="">
                    </div>
                </div>
                <div id="div_foraTabela">
                    <!--Crud-->
                    <div id="div_conteudo">
                        <!--Tabela Cargos-->
                        <div id="tabela_crud_titulos">
                            <!--Título da Tabela-->
                            <div class="titulo_colunaPoucosCampos">
                                Pergunta
                            </div>
                            <div class="titulo_colunaPoucosCampos">
                                Resposta
                            </div>
                            <div class="titulo_2opcColuna">
                                Opções
                            </div>
                        </div>
                        <?php
                            $sql = "select * from tbl_faq";

                            $select = mysql_query($sql) or die(mysql_error());

                            while($rs = mysql_fetch_array($select)){
                        ?>
                        <div class="tabela_crud_conteudo">
                            <div class="conteudo_colunaObs">
                                <div class="div_textoConteudoObs">
                                    <span class="span_centralizar"><?php echo($rs['pergunta']); ?></span>
                                </div>
                            </div>
                            <div class="conteudo_colunaObs">
                                <div class="div_textoConteudoObs">
                                    <span class="span_centralizar"><?php echo($rs['resposta']); ?></span>
                                </div>
                            </div>
                            <div class="coluna_2opcoes">
                                <!--Alterar-->
                                <a href="crud_faq.php?modo=alterar&id=<?php echo($rs['id_faq']); ?>">
                                    <div class="opcao_registro">
                                        <div class="imagem_opcao">
                                            <img src="img/alterar.png" alt="" title="Alterar">
                                        </div>
                                    </div>
                                </a>
                                <!--Apagar-->
                                <a href="crud_faq.php?modo=deletar&id=<?php echo($rs['id_faq']); ?>">
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
                    <img src="img/adicionarIcon.png" alt="" title="Cadastrar Item do FAQ">
                </button>
            </section>
            <!--Rodapé-->
            <?php include_once('rodape/rodape.php'); ?>
        </div>
    </body>
</html>
